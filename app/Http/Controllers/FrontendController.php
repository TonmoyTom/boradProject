<?php

namespace App\Http\Controllers;

use App\Background;
use App\Board;
use App\Subject;
use Illuminate\Http\Request;

class FrontendController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }




    public function index()
    {

        $backgrounds = Background::with('subjects.boards.qustions.answers')->get();
        return view('welcome', compact('backgrounds'));
    }


    public function subject($slug)
    {
        $backgrounds = Background::with('subjects.boards')->where('slug', $slug)->first();
        $subject = $backgrounds->subjects->groupBy(['class', 'groupname']);

        // dd($subject);


        // $backgrounds = Background::with(['subjects.boards.qustions.answers' => function ($query) {
        //     $query->select('subjects.bg_id');
        //     $query->groupBy('class');
        // }])->where('slug', $slug)->first();

        // $backgrounds = Background::with([
        //     'subjects' => function ($query) {
        //         return $query->groupBy('class');
        //     },
        //     'boards.qustions.answers'
        // ])->where('slug', $slug)->first();

        // $subject = Subject::all();

        // dd($subject);

        return view('subject', compact('subject'));
    }

    public function board($slug)
    {

        $subjects = Subject::with('boards.qustions.answers')->where('slug', $slug)->first();

        $board = $subjects->boards->groupBy(['name', 'year']);


        return view('boards', compact('board'));
    }


    public function answer($slug)
    {

        $boards = Board::with('subjects.qustions.answers')->where('slug', $slug)->first();

        // dd($boards);


        return view('qustion', compact('boards'));
    }
}
