<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'cover_image',
        'name',
        'summary', 
        'author',
        'price',
        'category'
    ];
}