<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function create()
    {
        return $this->student->CreateStudent();

    }

    public function index()
    {
        return $this->student->AllStudents();

    }

    public function store(Request $request){
        return $this->student->StoreStudent($request);
    }

}
