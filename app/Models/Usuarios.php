<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuarios extends Authenticatable implements AuthenticatableContract, JWTSubject
{
    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'id_resort',
        'id_nivel',
        'contrasena',
    ];

    // Define la relación con el resort
    public function resort()
    {
        return $this->belongsTo(Resorts::class, 'id_resort', 'id');
    }

    // Define la relación con el nivel
    public function nivel()
    {
        return $this->belongsTo(Niveles::class, 'id_nivel', 'id');
    }

    // Implementa los métodos necesarios para JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
