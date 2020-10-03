<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table='students';

    protected $primaryKey = 'std_id';
						

    protected $fillable=[
        "std_full_name",
        "std_father_name",
        "std_mother_name",
        "std_phone",
        "std_email",
        "std_roll",
        "std_registration",
        "std_dept_id",
        "std_gender",
        "std_bllod",
        "std_section_id",
        "std_class_id",
         "std_dob",
         "std_image",
];

    public function department()
    {
        return $this->belongsTo('App\Department','std_dept_id');
    }
    public function studentClass()
    {
        return $this->belongsTo('App\StudentClass','std_class_id');
    }
    public function section()
    {
        return $this->belongsTo('App\StudentSection','std_section_id');
    }

}
