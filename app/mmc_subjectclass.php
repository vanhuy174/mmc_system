<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_subjectclass extends Model
{
    protected $table="mmc_subjectclasses";
    protected $fillable=[
        'mmc_subjectclassid', 'mmc_subjectclassname', 'mmc_employeeid',
        'mmc_subjectid',
    ];
}
