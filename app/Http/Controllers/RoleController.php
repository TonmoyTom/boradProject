<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;

class RoleController extends Controller
{


    public function index()
    {

        $this->checkPermission("role.all");
        $roles =  Role::whereKeyNot(1)->orderBy('id', 'asc')->get();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {


        $this->checkPermission("role.create");
        $permission =  Permission::all();
        $premission_groups = User::getpermissiongroup();
        return view('admin.role.create', compact('permission', 'premission_groups'));
    }

    public function store(Request $request)
    {


        $this->checkPermission("role.store");

        $rules = [
            'name' => 'required|max:100|unique:roles',
            'permissions' => 'required',

        ];
        $customMessage = [
            'name.required' => 'Name Is Requerd',
            'permissions.required' => 'Permissions Not Select',
        ];

        $this->validate($request, $rules, $customMessage);


        // $role = Role::where('name', $request->name)->first();
        $permission = $request->input('permissions');

        if (!empty($permission)) {
            $role =  Role::create(['name' => $request->name]);
            $role->syncPermissions($permission);
        } else {

            return redirect()->route('role.create')->with('error', 'Input your Role!');
        }

        return redirect()->route('role.all')->with('success', 'Role Has Submit!');
    }

    public function edit($id)
    {

        $this->checkPermission("role.edit");
        $ids = Crypt::decrypt($id);

        $roles = Role::findOrFail($ids);

        $premission_groups = User::getpermissiongroup();

        $permission =  Permission::all();
        return view('admin.role.edit', compact('permission', 'roles', 'premission_groups'));
    }

    public function update(Request $request, $id)
    {

        $this->checkPermission("role.update");
        $ids = Crypt::decrypt($id);
        $rules = [
            'name' => 'required|max:100|unique:roles,name,' . $ids,
            'permissions' => 'required',
        ];
        $customMessage = [
            ' name.required' => 'Name Is Requerd',
            'permissions.required' => 'Permissions Not Select',
        ];

        $this->validate($request, $rules, $customMessage);


        // $role = Role::where('name', $request->name)->first();
        $permission = $request->input('permissions');

        if (!empty($permission)) {
            $role =  Role::findOrfail($ids);
            $role->syncPermissions($permission);
            $role->name = $request->name;
            $role->save();
        } else {

            return redirect()->route('role.edit')->with('error', 'Input your Role!');
        }

        return redirect()->route('role.all')->with('success', 'Role Has upadte!');
    }

    public function delete($id)
    {
        $this->checkPermission("role.delete");
        $ids = Crypt::decrypt($id);
        $role =  Role::findOrfail($ids);
        $role->delete();
        return redirect()->route('role.all')->with('success', 'Role Has delete!');

    }
}
