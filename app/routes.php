<?php

$app->get('/', 'HomeController:index')->setName('index');
$app->get('/users', 'UserController:index');
$app->get('/users/store', 'UserController:store');
