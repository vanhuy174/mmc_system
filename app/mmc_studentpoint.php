<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_studentpoint extends Model
{
    protected $table="mmc_studentpoints";
    protected $fillable=[
        'mmc_studentid', 'mmc_subjectclassid', 'diligentpoint',
        'point1','point2','point3','point4','testscore','mmc_note',
    ];

    public function student()
	{
	    return $this->belongsTo('App\mmc_student', 'mmc_studentid', 'mmc_studentid');
	}
}
