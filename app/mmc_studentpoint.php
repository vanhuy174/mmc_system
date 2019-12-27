<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_studentpoint extends Model
{
    protected $table="mmc_studentpoints";
    protected $fillable=[
        'mmc_studentid', 'mmc_subjectclassid', 'diligentpoint',
        'point1','point2','point3','point4','testscore','mmc_note','point_ratio','mmc_10grade','mmc_4grade',
    ];

    public function student()
	{
	    return $this->belongsTo('App\mmc_student', 'mmc_studentid', 'mmc_studentid');
	}

	public function subject()
	{
	    return $this->belongsTo('App\mmc_subject', 'mmc_subjectid', 'mmc_subjectid');
	}
    public function subjectclass()
    {
        return $this->hasMany('App\mmc_subjectclass', 'mmc_subjectclassid', 'mmc_subjectclassid');
    }
}
