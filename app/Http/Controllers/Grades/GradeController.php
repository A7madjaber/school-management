<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use Illuminate\Http\Request;


class GradeController extends Controller
{
    public function index(){


        $grades=Grade::withCount('classrooms')->get();
        return view('admin.grades.index',compact('grades'));
    }

    public function store(StoreGrades $request)
    {
//        if(Grade::where('Name->ar',$request->Name)->orwhere('Name->en',$request->Name_en)->exists()){
//
//            return redirect()->back()->withErrors([trans('Grades_trans.exists')]);
//        }



        try {

            Grade::create([
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name],
                'notes' => $request->Notes
            ]);

            return redirect()->back()->with(['message' => trans('messages.success'), 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function update(StoreGrades $request){

        try {
            Grade::findOrFail($request->id)->update([

                'name'=>['en'=>$request->Name_en,'ar'=>$request->Name],
                'notes'=>$request->Notes
            ]);

            return redirect()->back()->with(['message' => trans('messages.Update'), 'alert-type' => 'success']);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }



    }
    public function destroy(Request $request)
    {
        try {
            $grade= Grade::findOrFail($request->id);
            $grade->delete();
            return response()->json(['message' => trans('messages.Delete'),'status'=>true],200);

        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }


}


}

