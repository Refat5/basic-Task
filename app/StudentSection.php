<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSection extends Model
{
    protected $table='student_sections';

    protected $primaryKey = 'sec_id';

    protected $fillable=['sec_name','sec_details'];
}
