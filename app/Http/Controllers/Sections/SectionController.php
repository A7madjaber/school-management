<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){
        $teachers=Teacher::all();
        $grades=Grade::all();
        return view('admin.sections.index',compact('grades','teachers'));
    }


    public function store(StoreSections  $request)
    {

        try {

          $section=  Section::create([
                'name' => ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar],
                'grade_id'=>$request->Grade_id,
                'class_id'=> $request->Class_id,

            ]);

            $section->teachers()->attach($request->teacher_id);
            return redirect()->back()->with(['message' => trans('messages.success'), 'alert-type' => 'success']);

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(StoreSections $request)
    {

        try {

            $status=$request->Status ? 1 :0;
            $section = Section::findOrFail($request->id);
            $section->update([
                'name'=> ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
                'grade_id'=>$request->Grade_id,
                'class_id'=>$request->Class_id,
                'status'=>$status,

            ]);


            if (isset($request->teacher_id)){
                $section->teachers()->sync($request->teacher_id);

            }

            return redirect()->route('admin.section.index')->with(['message' => trans('messages.success'), 'alert-type' => 'success']);
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
        try {
            $section = Section::findOrFail($request->id);
            $section->delete();
            return response()->json(['message' => trans('messages.Delete'), 'status' => true], 200);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
