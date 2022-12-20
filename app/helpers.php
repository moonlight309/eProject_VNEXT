<?php

use App\Enums\UserRoleEnum;

if (!function_exists('checkAdmin')) {
    function checkAdmin()
    {
        return auth()->user()->role === UserRoleEnum::ADMIN;
    }
}

if (!function_exists('checkUser')) {
    function checkUser()
    {
        return auth()->user()->role === UserRoleEnum::USER;
    }
}