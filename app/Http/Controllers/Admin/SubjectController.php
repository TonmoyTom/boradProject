<?php

namespace App\Http\Controllers\Admin;

use App\Background;
use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SubjectController extends Controller
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
        $subject = Subject::with('backgrounds')->orderBy('id', 'asc')->get();
        return view('admin.subject.index', compact('subject'));
    }

    public function create()
    {
        $backgrounds = Background::all();
        $subject = Subject::with('backgrounds')->orderBy('id', 'asc')->get();
        return view('admin.subject.create', compact('subject', 'backgrounds'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|',
            'slug' => 'required|unique:backgrounds,slug',
            'bg_id' => 'required|integer',
            'class' => 'required',


        ]);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->bg_id = $request->bg_id;
        $cls = strtolower($request->class);
        $subject->class = $cls;
        $str = strtolower($request->slug);
        $subject->groupname = strtok($request->name, " ");
        $subject->slug = preg_replace('/\s+/', '-', $str);
        $subject->save();



        $notification = array(
            'messege' => 'Subject Insert successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('subjects.all')->with($notification);
    }

    public function subjectssstatus(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);
        if ($data['status'] == "Active") {
            $status = 0;
        } else {
            $status = 1;
        }

        Subject::where('id', $data['section_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
    }


    public function view($id)
    {

        $ids =  Crypt::decrypt($id);
        $subject = Subject::with('backgrounds')->where('id', $ids)->first();
        return view('admin.subject.view', compact('subject'));
    }

    public function edit($id)
    {

        $ids =  Crypt::decrypt($id);
        $subject = Subject::with('backgrounds')->where('id', $ids)->first();
        $backgrounds = Background::all();

        // dd($subject);
        return view('admin.subject.edit', compact('backgrounds', 'subject'));
    }

    public function update(Request $request, $id)
    {


        $ids =  Crypt::decrypt($id);
        $validatedData = $request->validate([
            'name' => 'required|',
            'slug' => "required|unique:subjects,slug, $ids",
            'bg_id' => 'required|',
            'class' => 'required',


        ]);


        $subject = Subject::findOrFail($ids);;
        $subject->name = $request->name;
        $subject->bg_id = $request->bg_id;
        $cls = strtolower($request->class);
        $subject->class = $cls;
        $str = strtolower($request->slug);
        $subject->groupname = strtok($request->name, " ");
        $subject->slug = preg_replace('/\s+/', '-', $str);
        $subject->save();


        $notification = array(
            'messege' => 'Subject Update successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('subjects.all')->with($notification);
    }

    public function delete($id)
    {




        $ids =  Crypt::decrypt($id);
        $subjects = Subject::findOrFail($ids);
        if (!is_null($subjects)) {
            $subjects->delete();
        }
        $notification = array(
            'messege' => 'Subjects Delete successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
