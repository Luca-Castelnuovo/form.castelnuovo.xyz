<?php

use CQ\Middleware\JSON;
use CQ\Middleware\Form;
use CQ\Middleware\Session;
use CQ\Routing\Middleware;
use CQ\Routing\Route;
use App\Middleware\JSONorFormMiddleware;

Route::$router = $router->get();
Middleware::$router = $router->get();

Route::get('/', 'GeneralController@index');
Route::get('/error/{code}', 'GeneralController@error');

Middleware::create(['prefix' => '/auth'], function () {
    Route::get('/request', 'AuthController@request');
    Route::get('/callback', 'AuthController@callback');
    Route::get('/logout', 'AuthController@logout');
});

Middleware::create(['middleware' => [Session::class]], function () {
    Route::get('/dashboard', 'UserController@dashboard');
});

Middleware::create(['prefix' => '/site', 'middleware' => [Session::class]], function () {
    Route::post('', 'SiteController@create', JSON::class);
    Route::delete('/{id}', 'SiteController@delete');
});

Route::post('/send/{id}', 'SendController@send', JSONorFormMiddleware::class);

// TODO: remove once middleware is finished
Route::post('/form/{id}', 'SendController@form', Form::class);
Route::post('/api/{id}', 'SendController@api', JSON::class);
