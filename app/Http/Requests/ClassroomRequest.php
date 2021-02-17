<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'List_Classes.*.Name' => 'required',
            'List_Classes.*.Name_class_en' => 'required',
            'List_Classes.*.Grade_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name_Class_en.required' => trans('validation.required'),
            'Grade_id.required' => trans('validation.required'),


        ];
    }
}

