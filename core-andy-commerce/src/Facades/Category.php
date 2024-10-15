<?php

namespace AndyCommerce\Core\Facades;

class Category extends Facade {
    
    protected static function getFacadeAccessor(){
        return "andycommerce-core";
    }

    final public const VERSION = '1.0.1';
}