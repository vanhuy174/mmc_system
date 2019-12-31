<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_employee_delete extends Model
{
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

    /** lấy thông tin bảng giảng viên */
    protected $table = "mmc_employees";
    public $timestamps = false;
}
