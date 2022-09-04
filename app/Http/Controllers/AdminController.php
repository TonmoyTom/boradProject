<?php

namespace App\Http\Controllers;

use App\Mail\UserSendmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function profile()
    {
        return view('admin.profile');
    }


    public function profilechange()
    {
        $admindetails = User::where('email', Auth::user()->email)->first();
        return view('admin.profilechange')->with(compact('admindetails'));
    }

    public function oldPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['old_password'], Auth::user()->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }



    public function upadteprofilestore(Request $request)
    {


        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required|unique:users,name',
                'email' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Name Is Requerd',
                'email.required' => 'email Is Requerd',
            ];
            $this->validate($request, $rules, $customMessage);

            if (Hash::check($data['old_password'], Auth::user()->password)) {
                User::where('email', Auth::user()->email)->update(['name' => $data['name'], 'email' => $data['email']]);
                return redirect()->route('admin.profile.change')->with('success', 'Your current profile  has Been Change!');
            } else {
                return redirect()->route('admin.profile.change')->with('error', 'Your current Password Is Incorrect!');
            }
        }
    }


    public function passwordchange()
    {
        $admindetails = User::where('email', Auth::user()->email)->first();
        return view('admin.passwordchange')->with(compact('admindetails'));
    }

    public function updatepassword(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();


            $rules = [
                'name' => 'required',
                'email' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Name Is Requerd',
                'email.required' => 'email Is Requerd',
            ];

            $this->validate($request, $rules, $customMessage);

            if (Hash::check($data['old_password'], Auth::user()->password)) {
                if ($data['new_password'] == $data['confirm_pass']) {
                    User::where('id', Auth::user()->id)->update(['password' => bcrypt($data['new_password']), 'name' => $data['name'], 'email' => $data['email']]);
                    return redirect()->route('admin.password.change')->with('success', 'Your Password Has been Change!');
                } else {
                    return redirect()->route('admin.password.change')->with('error', 'Your  Password Is Not Match!');
                }
            } else {
                return redirect()->route('admin.password.change')->with('error', 'Your current Password Is Incorrect!');
            }
        }
    }

    public function allusers()
    {
        $this->checkPermission("users.all");
        $allUser = User::whereKeyNot(1)->orderBy('id', 'asc')->get();
        return view('admin.user.index', compact('allUser'));
    }

    public function usercreate()
    {
        $this->checkPermission("users.create");
        $role =  Role::whereKeyNot(1)->get();
        return view('admin.user.create', compact('role'));
    }

    public function store(Request $request)
    {
        $this->checkPermission("users.store");
        $rules = [
            'name' => 'required|unique:users',
            'email' => 'required',
            'password' => 'required',

            'isAdmin' => 'required',
        ];
        $customMessage = [
            'name.required' => 'Name Is Requerd',
            'email.required' => 'email Is Requerd',
            'password.required' => 'Password Is Requerd',
            'isAdmin.required' => 'Role Is Requerd',
        ];

        $this->validate($request, $rules, $customMessage);

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->isAdmin = $request->isAdmin;
        $users->password = Hash::make($request->password);
        if ($request->cpassword == $request->password) {
            if ($request->roles) {
                $users->assignRole($request->roles);
                $users->save();
                // Mail::to($request->email)->send(new UserSendmail($data)); //default mail j pataise
            }
            // Mail::to($request->email)->send(new UserSendmail($data)); //default mail j pataise
            $users->save();
            return redirect()->route('users.all')->with('success', 'User Create!');
        } else {
            return back();
        }
    }

    public function view($id)
    {
        $this->checkPermission("users.view");
        $ids = Crypt::decrypt($id);
        $users = User::findOrFail($ids);
        return view('admin.user.view', compact('users'));
    }


    public function edit($id)
    {

        $this->checkPermission("users.edit");
        $ids = Crypt::decrypt($id);
        $users = User::findOrFail($ids);

        $role =   Role::all();

        return view('admin.user.edit', compact('users', 'role'));
    }

    public function update(Request $request, $id)
    {
        $this->checkPermission("users.update");
        $ids = Crypt::decrypt($id);
        $rules = [
            'name' => 'required|max:100|unique:users,name,' . $ids,
            'email' => 'required|',
        ];
        $customMessage = [
            'name.required' => 'Name Is Requerd',
            'email.required' => 'email Is Requerd',
        ];

        $this->validate($request, $rules, $customMessage);


        $users =  User::findOrfail($ids);
        $users->name = $request->name;
        $users->email = $request->email;

        $users->roles()->detach();

        if (empty($request->password && $request->cpassword)) {
            if ($request->roles) {
                $users->assignRole($request->roles);
                $users->save();
                return redirect()->route('users.all')->with('success', 'User Create!');
            }
            $users->save();
            return redirect()->route('users.all')->with('success', 'User Create!');
        } else {
            if ($request->cpassword == $request->password) {
                if ($request->roles) {
                    $users->assignRole($request->roles);
                    $users->save();
                    return redirect()->route('users.all')->with('success', 'User Create!');
                }
                $users->save();
                return redirect()->route('users.all')->with('success', 'User Create!');
            } else {
                return redirect()->route('users.edit')->with('error', 'User Create!');
            }
        }
    }

    public function delete($id)
    {
        $this->checkPermission("users.delete");
        $ids = Crypt::decrypt($id);
        $users =  User::findOrfail($ids);
        $users->delete();
        return redirect()->route('users.all')->with('success', 'User Has delete!');


    }
}
