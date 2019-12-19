<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_class extends Model
{
    protected $table="mmc_classes";
    protected $fillable=[
        'mmc_classid', 'mmc_classname', 'mmc_numstudent',
        'mmc_major', 'mmc_headteacher', 'mmc_monitor',
        'mmc_vicemonitor', 'mmc_secretary', 'mmc_vicesecretary1','mmc_vicesecretary2',
    ];
}
