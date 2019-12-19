<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_education extends Model
{
    protected $table="mmc_educations";
    protected $fillable=[
        'mmc_majorid','mmc_course','mmc_total',
    ];
}
