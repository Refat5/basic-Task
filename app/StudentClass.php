<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $table='student_classes';

    protected $primaryKey = 'clas_id';

    protected $fillable=['clas_name','clas_details'];
}
