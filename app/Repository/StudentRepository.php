<?php
namespace App\Repository;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface {


    public function AllStudents(){

     $students= Student::all();
     return view('admin.student.index',compact('students'));
    }


    public function CreateStudent(){
        $data['my_classes']=Grade::all();
        $data['parents']=MyParent::all();
        $data['Genders']=Gender::all();
        $data['nationals']=Nationalitie::all();
        $data['bloods']=Type_Blood::all();
        return view('admin.student.create',$data);
    }


    public function StoreStudent($request){

        try {

            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            return redirect()->route('admin.student.index')->with(['message' => trans('messages.success'), 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
