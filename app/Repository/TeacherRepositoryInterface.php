<?php
namespace App\Repository;

interface TeacherRepositoryInterface{

    public function AllTeachers();

    public function StoreTeachers ($request);

    public function createTacher ();

    public function editTeacher($request);

    public function updateTeachers($request,$id);

    public function DestroyTeacher($request);



}
