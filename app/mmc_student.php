<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_student extends Model
{
    protected $table="mmc_students";
    protected $fillable = [
                            'mmc_studentid',
                             'mmc_course',
                            'mmc_classid',
                            'mmc_fullname',
                            'mmc_dateofbirth',
                            'mmc_gender',
                            'mmc_email',
                            'mmc_phone',
                            'mmc_address',
                            'mmc_ethnic',
                            'mmc_religion',
                            'mmc_reward',
                            'mmc_status',
                            'mmc_descipline',
                            'mmc_personalid',
                            'mmc_dormitory',
                            'mmc_room_dormitory',
                            'mmc_landlord_name',
                            'mmc_landlord_phone',
                            'mmc_landlord_address',
                            'mmc_status',
                            'mmc_father',
                            'mmc_fathernationality',
                            'mmc_fatherethnic',
                            'mmc_fatherreligion',
                            'mmc_fatheraddress',
                            'mmc_fatherphone',
                            'mmc_fatheremail',
                            'mmc_fatherjob',
                            'mmc_mother',
                            'mmc_mothernationality',
                            'mmc_motherethnic',
                            'mmc_motherreligion',
                            'mmc_motheraddress',
                            'mmc_motherphone',
                            'mmc_motheremail',
                            'mmc_motherjob',
                            'mmc_course',
    						];

    public function class(){
        return $this->belongsTo('App\mmc_class', 'mmc_classid', 'mmc_classid');
    }
    public function pointdetail(){
        return $this->hasOne('App\mmc_pointdetails', 'mmc_studentid', 'mmc_studentid');
    }
}
