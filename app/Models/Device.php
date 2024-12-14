<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location','latitude','longitude'];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
