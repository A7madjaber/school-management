<?php
namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{


    public function AllTeachers()
    {
     $teachers= Teacher::all();
     return view('admin.teacher.index',compact('teachers'));
    }

    public function createTacher(){
        $genders = Gender::all();
        $specializations= Specialization::all();
        return view('admin.teacher.create',compact('specializations','genders'));

    }


    public function StoreTeachers($request){

        try {
            Teacher::create([
                'Name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'Password'=>Hash::make($request->Password),
                ]+$request->except('Name_ar','Name_en'));
            return redirect()->route('admin.teacher.index')->with(['message' => trans('messages.success'), 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function editTeacher($id){
        $teacher= Teacher::findOrFail($id);
        $genders = Gender::all();
        $specializations= Specialization::all();
        return view('admin.teacher.edit',
            compact('specializations','genders','teacher'));
    }

    public function updateTeachers($request,$id){

        $teacher=Teacher::findOrFail($id);

        try {

            $teacher->update([
                    'Name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                    'Password'=>Hash::make($request->Password),
                ]+$request->except('Name_ar','Name_en'));
            return redirect()->route('admin.teacher.index')->with(['message' => trans('messages.success'), 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function DestroyTeacher($request)
    {
        try {
            $teacher= Teacher::findOrFail($request->id);
            $teacher->delete();
            return response()->json(['message' => trans('messages.Delete'),'status'=>true],200);

        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }
}
