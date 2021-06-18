<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('login', 'LoginController@login');
$router->post('login', 'LoginController@auth');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('content', 'TenantConroller@index');
    $router->get('content/{id}', 'TenantConroller@show');
    $router->post('command', 'TenantConroller@process');
    $router->group(['prefix' => 'resources', 'namespace' =>'Resources'], function () use ($router) {
       $router->get('tenant[/{id}]', 'TenantController@getTenant');
        $router->get('user[/{id}]', 'UserController@getUser');

    });
});


$router->group(['prefix' => "sample-data"], function () use ($router) {
    $router->get('/import-users', "SampleDataController@importUsers");
    $router->get('/view-users', "SampleDataController@viewSampleUsers");
    $router->get('/import-tenants', "SampleDataController@importTenants");
    $router->get('/view-tenants', "SampleDataController@viewSampleTenants");
    $router->get('/import-contents', "SampleDataController@importContents");
});
