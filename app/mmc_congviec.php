<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mmc_congviec extends Model
{
    protected $fillable = [
        'id',
        'mmc_nguoigui',
        'mmc_nguoinhan',
        'mmc_tieude',
        'mmc_noidung',
        'mmc_ghichu',
        'mmc_trangthai',
        'mmc_batdau',
        'mmc_ketthuc',
        'mmc_ketqua',
        'mmc_danhgia'
    ];
    protected $table = "mmc_congviecs";
    public $timestamps = false;

    public function nguoigui()
    {
        return $this->belongsTo('App\mmc_employee', 'mmc_nguoigui','mmc_employeeid');
    }

    public function nguoinhan()
    {
        return $this->belongsTo('App\mmc_employee', 'mmc_nguoinhan','mmc_employeeid');
    }
}
