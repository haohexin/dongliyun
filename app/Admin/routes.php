<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('users', UserController::class);

    $router->resource('devices', DeviceController::class);
    $router->resource('deviceCategories', DeviceCategoryController::class);
    $router->resource('deviceFields', DeviceFieldController::class);


});
