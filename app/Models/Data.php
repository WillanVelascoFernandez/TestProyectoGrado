<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Data
 *
 * @property $id
 * @property $nombre
 * @property $id_sensor
 * @property $valor
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Data extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'id_sensor', 'valor'];


}
