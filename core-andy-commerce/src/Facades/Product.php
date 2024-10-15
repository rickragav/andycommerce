<?php

namespace AndyCommerce\Core\Facades;

use Illuminate\Support\Facades\Facade;

class Product extends Facade {
    
    protected static function getFacadeAccessor(){
        return "product-core";
    }

    final public const VERSION = '1.0.1';
}