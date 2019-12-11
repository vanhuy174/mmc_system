<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class mmc_employee extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mmc_name', 'email', 'password','mmc_employeeid', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** lấy thông tin bảng giảng viên */
    protected $table = "mmc_employees";

    public $timestamps = false;

    public function subjectclass()
    {
        return $this->hasMany('App\mmc_subjectclass', 'mmc_employeeid', 'mmc_employeeid');
    }

    public function department()
    {
        return $this->belongsTo('App\mmc_department', 'mmc_deptid', 'mmc_deptid');
    }
}
