<?php

namespace App\Http\Controllers\Traits;

trait TraitController
{
    protected $business;

    public function __construct()
    {
        $class = str_replace('Http\Controllers', 'Business', get_class($this));
        $class = str_replace('Controller', '', $class);
        if (class_exists($class)) {
            $this->business = new $class();
        };
    }
}
