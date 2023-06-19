<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exercises extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inventory',
        'base',
        'insulating',
        'masses',
        'relief',
        'muscle_group',
        'back_pain',
        'varicose',
        'diastasis',
        'knee_pain',
        'high_pressure',
    ];
}
