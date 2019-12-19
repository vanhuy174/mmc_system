<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_pointdetails extends Model
{
    protected $table="mmc_pointdetails";
    protected $fillable=[
        'mmc_semesterid', 'mmc_studentid', 'mmc_subjectid',
        'mmc_yearid','mmc_10grade','mmc_4grade',
    ];

    public function student()
    {
        return $this->belongsTo('App\mmc_student', 'mmc_studentid', 'mmc_studentid');
    }

    public function subject()
    {
        return $this->belongsTo('App\mmc_subject', 'mmc_subjectid', 'mmc_subjectid');
    }
}
