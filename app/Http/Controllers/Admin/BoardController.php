<?php

namespace App\Http\Controllers\Admin;

use App\Board;
use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BoardController extends Controller
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
        $boards = Board::with('subjects.backgrounds')->orderBy('id', 'asc')->get();

        // dd($boards);
        return view('admin.board.index', compact('boards'));
    }

    public function create()
    {
        $subject = Subject::all();
        return view('admin.board.create', compact('subject'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|',
            'slug' => 'required|unique:boards,slug',
            'sub_id' => 'required|integer',
            'year' => 'required',


        ]);

        $boards = new Board();
        $boards->name = $request->name;
        $boards->sub_id = $request->sub_id;
        $boards->year = $request->year;
        $str = strtolower($request->slug);
        $boards->slug = preg_replace('/\s+/', '-', $str);
        $boards->save();



        $notification = array(
            'messege' => 'Board Insert successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('boards.all')->with($notification);
    }

    public function boardssstatus(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);
        if ($data['status'] == "Active") {
            $status = 0;
        } else {
            $status = 1;
        }

        Board::where('id', $data['section_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
    }

    public function view($id)
    {

        $ids =  Crypt::decrypt($id);
        $boards = Board::with('subjects')->where('id', $ids)->first();
        return view('admin.board.view', compact('boards'));
    }

    public function edit($id)
    {

        $ids =  Crypt::decrypt($id);
        $boards = Board::findOrFail($ids);
        $subject = Subject::all();
        return view('admin.board.edit', compact('boards', 'subject'));
    }

    public function update(Request $request, $id)
    {


        $ids =  Crypt::decrypt($id);
        $validatedData = $request->validate([
            'name' => 'required|',
            'slug' => "required|unique:boards,slug, $ids",
            'sub_id' => 'required|integer',
            'year' => 'required',


        ]);


        $boards = Board::findOrFail($ids);;
        $boards->name = $request->name;
        $boards->sub_id = $request->sub_id;
        $boards->year = $request->year;
        $str = strtolower($request->slug);
        $boards->slug = preg_replace('/\s+/', '-', $str);
        $boards->save();



        $notification = array(
            'messege' => 'boards Update successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('boards.all')->with($notification);
    }

    public function delete($id)
    {

        $ids =  Crypt::decrypt($id);
        $boards = Board::findOrFail($ids);
        if (!is_null($boards)) {
            $boards->delete();
        }
        $notification = array(
            'messege' => 'Boards Delete successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
