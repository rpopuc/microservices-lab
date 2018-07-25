<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('user', 'UserController@index');
