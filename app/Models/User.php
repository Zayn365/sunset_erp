<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'kod',
        'ad',
        'soyad',
        'mail',
        'sifre',
        'kullanici_tip',
        // ...other fields...
    ];

    protected $hidden = ['sifre'];

    // Tell Laravel which attribute is the password
    public function getAuthPasswordName(): string
    {
        return 'sifre';
    }

    // Return the password value
    public function getAuthPassword()
    {
        return $this->sifre;
    }

    public function isAdmin(): bool
    {
        return strtolower((string)$this->kullanici_tip) === 'admin';
    }
}
