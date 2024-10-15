<?php

if (!function_exists('greet_user')) {
    function greet_user($name)
    {
        return 'Hello, ' . $name;
    }
}



if (!function_exists('setActive')) {
    function setActive(array $route)
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return 'active';
                }
            }
        }
    }
}
