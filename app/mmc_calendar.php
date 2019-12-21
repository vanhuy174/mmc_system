<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_calendar extends Model
{
    protected $table="mmc_calendars";
    protected $fillable=[
        'mmc_subjectclassid', 'mmc_schedule', 'mmc_class',
        'mmc_classroom',
    ];
}

