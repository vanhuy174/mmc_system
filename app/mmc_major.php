<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_major extends Model
{
    protected $table="mmc_majors";
    protected $fillable=[
        'mmc_deptid', 'mmc_majorid', 'mmc_majorname','mmc_description','r','g','b'
    ];
}
