<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\MyParent;
use Illuminate\Http\Request;

class ParentController extends Controller
{


    public function destroy(Request $request)
    {
        try {
            $parent = MyParent::findOrFail($request->id);
            $parent->delete();
            return response()->json(['message' => trans('messages.Delete'), 'status' => true], 200);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
