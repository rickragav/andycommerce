<?php

namespace AndyCommerce\Core\Facades;

use Illuminate\Support\Facades\Facade;

class Brand extends Facade {
    
    protected static function getFacadeAccessor(){
        return "brand-core";
    }

    final public const VERSION = '1.0.1';
}