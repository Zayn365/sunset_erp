<?php

// app/Models/OrderLine.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'ordersdetay';
    protected $primaryKey = 'id';
    public $timestamps = false; // table doesn’t use created_at/updated_at

    protected $fillable = [
        'fis_no',
        'en',
        'boy',
        'm2',
        'renk',
        'mekanizma',
        'mekanizma_yon',
        'sistem',
        'ic_cam',
        'dis_cam',
        'miktar',
        'm2_fiyati',
        'kdv_yuzde',
        'satir_tutar',
        'satir_tutar_kdvli',
        'ic_cam_tutar',
        'dis_cam_tutar',
        'toplam_tutar',
        'kasa_renk',
        'alt_kasa_renk',
        'cam_cita_renk',
        'aciklama',
    ];

    protected $casts = [
        'en' => 'float',
        'boy' => 'float',
        'm2' => 'float',
        'miktar' => 'int',
        'm2_fiyati' => 'float',
        'kdv_yuzde' => 'float',
        'satir_tutar' => 'float',
        'satir_tutar_kdvli' => 'float',
        'ic_cam_tutar' => 'float',
        'dis_cam_tutar' => 'float',
        'toplam_tutar' => 'float',
    ];
}
