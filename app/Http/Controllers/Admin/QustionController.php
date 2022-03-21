<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Board;
use App\Http\Controllers\Controller;
use App\Qustion;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class QustionController extends Controller
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
        $qustions = Qustion::with('boards' , 'subjects' ,'subjects.backgrounds')->orderBy('id', 'asc')->get();


        return view('admin.qustion.index', compact('qustions'));
    }

    public function create()
    {
        $subject = Subject::all();
        $boards = Board::all();
        return view('admin.qustion.create', compact('subject', 'boards'));
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:qustions,slug',
            // 'slug' => 'required|unique:qustions,slug',
            'sub_id' => 'required|integer',
            'bd_id' => 'required|integer',


        ]);

        $str = strtolower($request->name);
        $strrmlower = strtolower(Str::random());
        $strdash = preg_replace('/\s+/', '-', $str);

        $question = Qustion::create([
            'name' => $request->name . "?",
            'sub_id' => $request->sub_id ,
            'bd_id' => $request->bd_id ,
            'slug' => $strdash . '-' . $strrmlower,
        ]);

        foreach($request->names as $key => $value){
           $answer =  Answer::create([
                'qus_id' => $question->id,
                'name' => $value,
                'points' => $data['point'][$key],
            ]);
        }

        $notification = array(
            'messege' => 'Qustion Insert Answer successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('qustions.all')->with($notification);


        // $str = Str::random(5);

        // print_r($str);
    }


    public function qustionssstatus(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);
        if ($data['status'] == "Active") {
            $status = 0;
        } else {
            $status = 1;
        }

        Qustion::where('id', $data['section_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
    }


    public function edit($id)
    {

        $subject = Subject::all();
        $boards = Board::all();
        $ids =  Crypt::decrypt($id);
        $qustions = Qustion::findOrFail($ids);
        return view('admin.qustion.edit', compact('qustions', 'subject', 'boards'));
    }




    public function update(Request $request, $id)
    {


        $ids =  Crypt::decrypt($id);
        $validatedData = $request->validate([
            'name' => "required|unique:qustions,name, $ids",

            'sub_id' => 'required|integer',
            'bd_id' => 'required|integer',

        ]);


        $qustions = Qustion::findOrFail($ids);
        $qustions->name = $request->name;
        $qustions->sub_id = $request->sub_id;
        $qustions->bd_id = $request->bd_id;
        $str = strtolower($request->name);
        $strrmlower = strtolower(Str::random());
        $strdash = preg_replace('/\s+/', '-', $str);
        $qustions->slug = $strdash . '-' . $strrmlower;
        // $str = strtolower($request->slug,);
        // $qustions->slug = preg_replace('/\s+/', '-', $str);
        $qustions->save();


        $notification = array(
            'messege' => 'Qustions Update successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('qustions.all')->with($notification);
    }


    public function view($id)
    {
        $subject = Subject::all();
        $boards = Board::all();
        $ids =  Crypt::decrypt($id);
        $qustions = Qustion::with(['boards.subjects.backgrounds', 'answers'])->where('id', $ids)->first();
        return view('admin.qustion.view', compact('qustions', 'subject', 'boards'));
    }

    public function delete($id)
    {




        $ids =  Crypt::decrypt($id);
        $Qustion = Qustion::findOrFail($ids);
        if (!is_null($Qustion)) {
            $Qustion->delete();
        }
        $notification = array(
            'messege' => 'Qustion Delete successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
