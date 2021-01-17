<?php

use Illuminate\Support\Facades\Route;
use SunLab\BackendRegistration\Classes\RegistrationIsOpen;
use SunLab\BackendRegistration\Controllers\RegistrationController;

Route::group(
    [
        'prefix' => Config::get('cms.backendUri').'/',
        'middleware' => ['web']
    ],
    function () {
        Route::match(['get', 'post'], 'register', function () {
            return (new RegistrationController())->run('register');
        })->middleware(RegistrationIsOpen::class);

        Route::get('coming-soon', function () {
            return (new RegistrationController())->run('comingSoon');
        });
    }
);
