<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $table = 'sensores';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'tipo_sensor',
        'longitud',
        'latitud'
    ];

    public function mediciones()
    {
        return $this->hasMany(Medicion::class);
    }
}