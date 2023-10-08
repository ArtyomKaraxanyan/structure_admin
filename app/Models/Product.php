<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'category_id',
        'name',
        'price',
        'description',
        'image',
    ];

    public function parent(){

        return $this->belongsTo(Category::class,'category_id')->first();
    }

}
