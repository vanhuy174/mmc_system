<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mmc_employee extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'mmc_name',
        'mmc_employeeid',
        'mmc_deptid',
        'mmc_avatar',
        'mmc_dateofbirth',
        'mmc_gender',
        'mmc_personalid',
        'mmc_dateofpid',
        'mmc_socialinsuranceid',
        'mmc_phone',
        'email',
        'password',
        'mmc_religion',
        'mmc_ethnic',
        'mmc_placeofbirth',
        'mmc_hometown',
        'mmc_address',
        'mmc_dateofrecruit',
        'mmc_position',
        'mmc_maintask',
        'mmc_nameofjob',
        'mmc_codeofjob',
        'mmc_salarylevel',
        'mmc_salaryratio',
        'mmc_salaryposition',
        'mmc_salaryother',
        'mmc_degree',
        'mmc_language',
        'mmc_itlevel',
        'mmc_politiclevel',
        'mmc_managementlevel',
        'mmc_partydate',
        'mmc_partydateprimary',
        'mmc_reward',
        'mmc_discipline',
        'mmc_heathlevel',
        'mmc_bloodgroup',
        'mmc_tall',
        'mmc_weight',
        'mmc_level'
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

    protected $softDelete = true;
    public $timestamps = false;

    public function subjectclass()
    {
        return $this->hasMany('App\mmc_subjectclass', 'mmc_employeeid', 'mmc_employeeid');
    }

    public function department()
    {
        return $this->belongsTo('App\mmc_department', 'mmc_deptid', 'mmc_deptid');
    }

    public function nguoigui()
    {
        return $this->belongsTo('App\mmc_congviec', 'mmc_employeeid', 'mmc_nguoigui');
    }

    public function nguoinhan()
    {
        return $this->belongsTo('App\mmc_congviec', 'mmc_employeeid', 'mmc_nguoinhan');
    }
}
