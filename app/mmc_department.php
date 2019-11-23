<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_department extends Model
{
    protected $table="mmc_departments";
    protected $fillable=[
        'mmc_deptid', 'mmc_deptname', 'mmc_description',
    ];
}
