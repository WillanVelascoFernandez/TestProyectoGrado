<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicion extends Model
{
    use HasFactory;

    protected $table = 'mediciones';

    protected $fillable = [
        'sensor_id',
        'tipo_medicion_id',
        'valor'
    ];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    public function tipoMedicion()
    {
        return $this->belongsTo(TipoMedicion::class);
    }
}