<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        													
            return [
                'std_full_name' => 'required',
                'std_father_name' => 'required',
                'std_mother_name' => 'required',
                'std_roll' => 'required',
                'std_image'=> 'mimes:jpg,jpeg,png|max:3048',
                'std_email' => 'required|email',
                'std_registration' => 'required',
                'std_phone' => 'required',    
                'std_dob' => 'required|date',
                'std_dept_id' => 'required',
                'std_section_id' => 'required',
                'std_class_id' => 'required',
               
            ];

    }
    public function name(){
        return [
            'std_full_name'=>'Name',
            'std_father_name'=>'Father Name',
            'std_mother_name'=>'Mother Name',
            'std_roll' => 'Roll',
            'std_image'=>'Image',
            'std_email'=>'Email',
            'std_phone'=>'Phone',
            'std_registration'=>'Registation',
            'std_dob'=>'Date OF Birth',
            'std_dept_id'=>'Department',
            'std_section_id'=>'Section',
            'std_class_id'=>'Class',

        ];
    }
}
