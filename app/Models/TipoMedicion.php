<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMedicion extends Model
{
    use HasFactory;

    protected $table = 'tipos_medicion';

    protected $fillable = [
        'nombre',
        'unidad'
    ];

    public function mediciones()
    {
        return $this->hasMany(Medicion::class);
    }
}