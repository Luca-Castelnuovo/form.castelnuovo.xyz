<?php

use CQ\Middleware\JSON;
use CQ\Middleware\Form;
use CQ\Middleware\Session;
use CQ\Middleware\RateLimit;
use CQ\Routing\Middleware;
use CQ\Routing\Route;

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

Route::get('/form/success', 'SendController@success');

Route::options('/form/{id}', 'SendController@cors');
Route::post('/form/{id}', 'SendController@form', [RateLimit::class, Form::class]);

Route::options('/api/{id}', 'SendController@cors');
Route::post('/api/{id}', 'SendController@api', [RateLimit::class, JSON::class]);
