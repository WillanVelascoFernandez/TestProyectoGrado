<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Medicione
 *
 * @property $id
 * @property $sensor_id
 * @property $tipo_medicion_id
 * @property $valor
 * @property $created_at
 * @property $updated_at
 *
 * @property Sensore $sensore
 * @property TiposMedicion $tiposMedicion
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Medicione extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['sensor_id', 'tipo_medicion_id', 'valor'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sensore()
    {
        return $this->belongsTo(\App\Models\Sensore::class, 'sensor_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tiposMedicion()
    {
        return $this->belongsTo(\App\Models\TiposMedicion::class, 'tipo_medicion_id', 'id');
    }
    
}
