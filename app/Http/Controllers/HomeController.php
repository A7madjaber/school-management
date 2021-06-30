<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function classrooms($id){
        $classes=Classroom::where('grade_id',$id)->pluck("name","id");
        return $classes;
    }

    public function sections($id){
        $section=Section::where('class_id',$id)->pluck("name","id");
        return $section;
    }
}
