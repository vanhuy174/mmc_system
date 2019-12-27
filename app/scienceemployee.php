<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scienceemployee extends Model
{
    protected $table="scienceemployees";
    protected $fillable=[
        'mmc_employeeid','mmc_missionid','mmc_link','mmc_status ','mmc_file',
    ];
    public function item()
    {
        return $this->hasOne('App\item','id','mmc_missionid');
    }
}
