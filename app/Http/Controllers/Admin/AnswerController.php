<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Qustion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class AnswerController extends Controller
{
    // public $users;
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('isAdmin');
    //     $this->middleware(function ($request, $next) {
    //         $this->users = Auth::user();
    //         return $next($request);
    //     });
    // }

    public function index()
    {
        $answer = Answer::with('qustions.boards.subjects.backgrounds')->orderBy('id', 'asc')->get();
        return view('admin.answer.index', compact('answer'));
    }


    public function create()
    {
        $qustion = Qustion::all();
        return view('admin.answer.create', compact('qustion'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:qustions,slug',
            'qus_id' => 'required|integer',



        ]);

        $answer = new Answer();
        $answer->name = $request->name;
        $answer->qus_id = $request->qus_id;
        $answer->points = $request->points;
        $str = strtolower($request->name);
        $strrmlower = strtolower(Str::random());
        $strdash = preg_replace('/\s+/', '-', $str);
        $answer->slug = $strdash . '-' . $strrmlower;
        // $str = strtolower($request->slug,);
        // $qustions->slug = preg_replace('/\s+/', '-', $str);
        $answer->save();



        $notification = array(
            'messege' => 'Answer Insert successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('answers.all')->with($notification);


        // $str = Str::random(5);

        // print_r($str);
    }

    public function answerssstatus(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);
        if ($data['status'] == "Active") {
            $status = 0;
        } else {
            $status = 1;
        }

        Answer::where('id', $data['section_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
    }

    public function edit($id)
    {

        $qustion = Qustion::all();
        $ids =  Crypt::decrypt($id);
        $answer = Answer::findOrFail($ids);
        return view('admin.answer.edit', compact('answer', 'qustion'));
    }

    public function update(Request $request, $id)
    {


        $ids =  Crypt::decrypt($id);
        $validatedData = $request->validate([
            'name' => "required|unique:qustions,name, $ids",

            'qus_id' => 'required|integer',


        ]);


        $answer = Answer::findOrFail($ids);
        $answer->name = $request->name;
        $answer->qus_id = $request->qus_id;
        $answer->points = $request->points;
        $str = strtolower($request->name);
        $strrmlower = strtolower(Str::random());
        $strdash = preg_replace('/\s+/', '-', $str);
        $answer->slug = $strdash . '-' . $strrmlower;
        // $qustions->slug = preg_replace('/\s+/', '-', $str);
        $answer->save();


        $notification = array(
            'messege' => 'Answer Update successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('qustions.all')->with($notification);
    }

    public function view($id)
    {

        $ids =  Crypt::decrypt($id);
        $answer = Answer::with('qustions.boards.subjects.backgrounds')->where('id', $ids)->first();
        return view('admin.answer.view', compact('answer'));
    }

    public function delete($id)
    {

        $ids =  Crypt::decrypt($id);
        $Answer = Answer::findOrFail($ids);
        if (!is_null($Answer)) {
            $Answer->delete();
        }
        $notification = array(
            'messege' => 'Answer Delete successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
