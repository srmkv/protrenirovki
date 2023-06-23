<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodDish extends Model
{
    use HasFactory;
    protected $fillable = [
        'day_food_id',
        'dish_id'
    ];
}
