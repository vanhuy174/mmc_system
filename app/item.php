<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $table="items";
    protected $fillable=[
        'listitems_id', 'mmc_mission', 'mmc_coefficient','mmc_sogiochuan',
    ];
    public function listitems()
    {
        return $this->belongsTo('App\listitem','id','listitems_id');
    }
}
