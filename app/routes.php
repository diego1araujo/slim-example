<?php

$app->get('/', 'HomeController:index')->setName('index');
$app->get('/users', 'UserController:index');
$app->post('/users/store', 'UserController:store');
