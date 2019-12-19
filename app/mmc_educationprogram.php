<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_educationprogram extends Model
{
    protected $table="mmc_educationprograms";
    protected $fillable=[
         'mmc_subjectid', 'mmc_majorid','mmc_course', 'mmc_semester', 'mmc_classify','mmc_elective',
    ];
}
