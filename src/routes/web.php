<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('user', 'UserController@index');
    $router->get('user/{userId}', 'UserController@show');
    $router->post('user', 'UserController@store');
    $router->put('user/{userId}', [
        'as' => 'user.update',
        'uses' => 'UserController@update'
    ]);
    $router->delete('user/{userId}', [
        'as' => 'user.delete',
        'uses' => 'UserController@delete'
    ]);
});
