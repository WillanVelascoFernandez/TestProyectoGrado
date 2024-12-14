<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Parameter
 *
 * @property $id
 * @property $module_id
 * @property $name
 * @property $unit
 * @property $created_at
 * @property $updated_at
 *
 * @property Module $module
 * @property Measurement[] $measurements
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Parameter extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['module_id', 'name', 'unit'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }
    
}
