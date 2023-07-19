<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exercises extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'type_train',
        'apparatus',
        'experience',
        'room',
    ];
}
