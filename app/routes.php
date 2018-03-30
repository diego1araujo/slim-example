<?php

$app->get('/', '\App\Controllers\HomeController:index');
$app->get('/users', '\App\Controllers\UserController:index');
$app->post('/users/store', '\App\Controllers\UserController:store');
