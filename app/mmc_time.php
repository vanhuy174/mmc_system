<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_time extends Model
{
    protected $table="mmc_times";
    protected $fillable=[
        'class_time', 'time_in', 'time_out',
        'season',
    ];
}
