<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('calc')) {

    function calc($a, $b)
    {
        return $a + $b;
    }
}

if (!function_exists('permission')) {

    function permission($permission)
    {
        return Auth::guard('admin')->user()->hasAnyPermission($permission) ? true : false;
    }
}

