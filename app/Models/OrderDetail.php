<?php

// app/Models/OrderDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'ordersdetay';
    public $timestamps = false;

    protected $fillable = [
        'fis_no',
        'en',
        'boy',
        'm2',
        'renk',
        'mekanizma_yon',
        'sistem',
        'slayt',
        'cam',
        'ic_cam',
        'dis_cam',
        'm2_fiyat',
        'tutar_doviz',
        'satir_tutar',
        'tutar',
        'aciklama',
        'poz',
        'kasa_renk',
        'alt_kasa_renk',
        'cam_cita_renk',
        'miktar',
    ];
}
