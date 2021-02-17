<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;


class ClassroomController extends Controller
{


    public function index()
    {
        $Grades = Grade::all();
        $classes = Classroom::all();
        return view('admin.classroom.index', compact('classes', 'Grades'));
    }


    public function store(ClassroomRequest $request)
    {


        $lists = $request->List_Classes;

        try {
            foreach ($lists as $list) {

                Classroom::create([
                    'name' => ['en' => $list['Name_class_en'], 'ar' => $list['Name']],
                    'grade_id' => $list['Grade_id'],
                ]);
            }
            return redirect()->back()->with(['message' => trans('messages.success'), 'alert-type' => 'success']);


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function update(ClassroomRequest $request)
    {

        try {
            Classroom::findOrFail($request->id)->update([

                'name' => ['en' => $request->Name_en, 'ar' => $request->Name],
                'grade_id' => $request->Grade_id
            ]);

            return redirect()->back()->with(['message' => trans('messages.Update'), 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $classroom = Classroom::findOrFail($request->id);
            $classroom->delete();
            return response()->json(['message' => trans('messages.Delete'), 'status' => true], 200);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);
        Classroom::whereIn('id', $delete_all_id)->delete();
        return redirect()->back()->with(['message' => trans('messages.Delete'), 'alert-type' => 'success']);

    }

    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $classes  = Classroom::where('grade_id',$request->Grade_id)->get();
        return view('admin.classroom.index', compact('classes', 'Grades'));

    }




}

