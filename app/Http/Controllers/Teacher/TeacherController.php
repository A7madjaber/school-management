<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }

    public function index()
    {
        return $this->teacher->AllTeachers();

    }

    public function create()
    {
      return $this->teacher->createTacher();

    }

    public function edit($id){

      return $this->teacher->editTeacher($id);
    }

    public function store(Request $request){
        return $this->teacher->StoreTeachers($request);
    }

    public function update(Request $request,$id){
        return $this->teacher->updateTeachers($request,$id);
    }

    public function destroy(Request $request){
        return $this->teacher->DestroyTeacher($request);
    }
}
