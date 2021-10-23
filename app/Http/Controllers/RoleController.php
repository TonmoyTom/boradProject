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

    public $users;
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {

        if (is_null($this->users) || !$this->users->can('role.all')) {
            abort(403, 'Not Access');
        }
        $roles =  Role::orderBy('id', 'asc')->get();


        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        if (is_null($this->users) || !$this->users->can('role.create')) {
            abort(403, 'Not Access');
        }

        $permission =  Permission::all();
        $premission_groups = User::getpermissiongroup();


        return view('admin.role.create', compact('permission', 'premission_groups'));
    }

    public function store(Request $request)
    {

        if (is_null($this->users) || !$this->users->can('role.store')) {
            abort(403, 'Not Access');
        }


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
        if (is_null($this->users) || !$this->users->can('role.edit')) {
            abort(403, 'Not Access');
        }

        $ids = Crypt::decrypt($id);

        $roles = Role::findOrFail($ids);

        $premission_groups = User::getpermissiongroup();

        $permission =  Permission::all();
        // dd($premissions);

        return view('admin.role.edit', compact('permission', 'roles', 'premission_groups'));
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->users) || !$this->users->can('role.update')) {
            abort(403, 'Not Access');
        }
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

        if (is_null($this->users) || !$this->users->can('role.all')) {
            abort(403, 'Not Access');
        }

        $ids = Crypt::decrypt($id);
        $role =  Role::findOrfail($ids);

        $okk =  $role->name;




        if (!is_null($role)) {
            if ($role->name == "superadmin") {
                return redirect()->route('role.all')->with('success', 'THis Is Default');
            } else {
                $role->delete();
                return redirect()->route('role.all')->with('success', 'Role Has delete!');
            }
        }
    }
}
