<?php

namespace App\Http\Controllers\Admin;

use App\Background;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BackgroundController extends Controller
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
        $background = Background::orderBy('id', 'asc')->get();
        return view('admin.background.index', compact('background'));
    }


    public function create()
    {

        return view('admin.background.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|',
            'slug' => 'required|unique:backgrounds,slug',

        ]);

        $backgrounds = new Background();
        $backgrounds->name = $request->name;
        $str = strtolower($request->slug);
        $backgrounds->slug = preg_replace('/\s+/', '-', $str);
        $backgrounds->save();



        $notification = array(
            'messege' => 'backgrounds Insert successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('backgrounds.all')->with($notification);
    }

    public function backgroundsstatus(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);
        if ($data['status'] == "Active") {
            $status = 0;
        } else {
            $status = 1;
        }

        Background::where('id', $data['section_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
    }

    public function edit($id)
    {

        $ids =  Crypt::decrypt($id);
        $backgrounds = Background::findOrFail($ids);
        return view('admin.background.edit', compact('backgrounds'));
    }

    public function update(Request $request, $id)
    {


        $ids =  Crypt::decrypt($id);
        $validatedData = $request->validate([
            'name' => 'required|',
            'slug' => "required|unique:backgrounds,slug, $ids",

        ]);


        $backgrounds = Background::findOrFail($ids);
        $backgrounds->link = $request->link;
        $str = strtolower($request->slug);
        $backgrounds->slug = preg_replace('/\s+/', '-', $str);
        $backgrounds->save();


        $notification = array(
            'messege' => 'backgrounds Update successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('backgrounds.all')->with($notification);
    }

    public function view($id)
    {

        $ids =  Crypt::decrypt($id);
        $backgrounds = Background::findOrFail($ids);
        return view('admin.background.view', compact('backgrounds'));
    }

    public function delete($id)
    {




        $ids =  Crypt::decrypt($id);
        $backgrounds = Background::findOrFail($ids);
        if (!is_null($backgrounds)) {
            $backgrounds->delete();
        }
        $notification = array(
            'messege' => 'Backgrounds Delete successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
