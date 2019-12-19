<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_subject extends Model
{
    protected $table="mmc_subjects";
    protected $fillable=[
        'mmc_subjectid', 'mmc_subjectname', 'mmc_description',
        'mmc_theory','mmc_practice',
    ];

    public function subjectclass()
	{
	    return $this->hasMany('App\mmc_subjectclass', 'mmc_subjectid');
	}
}
