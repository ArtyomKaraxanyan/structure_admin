<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'image',
    ];

    public function parent(){

        return $this->belongsTo(self::class,'parent_id')->first();
    }
    public function child(){

        return $this->hasMany(self::class,'parent_id')->get();
    }
    public function products(){

        return $this->hasMany(Product::class,'category_id')->get();
    }


}
