<?php

namespace App\Enums;






use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

class RoutingEnum{

    const NAME=['Categories','Products'];
    const VALUE=['list'=>'index','create'=>'create'];
    const Clases=[CategoryController::class,ProductController::class];


       public static function routeing(){

           return  array_combine(self::NAME, self::Clases);
       }



}
