<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'device_id', 'description'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function parameters()
    {
        return $this->hasMany(Parameter::class);
    }
}
