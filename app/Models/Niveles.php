<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveles extends Model
{
    protected $table = 'niveles';

    protected $fillable = [
        'nivel',
        'nombre',
    ];


}
