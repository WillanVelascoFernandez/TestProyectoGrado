<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = ['parameter_id', 'value', 'measured_at'];

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }  
}
