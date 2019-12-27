<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listitem extends Model
{
    protected $table="listitems";
    protected $fillable=[
        'mmc_mission'
    ];
    public function items()
    {
        return $this->hasMany('App\item','listitems_id','id');
    }
}
