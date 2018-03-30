<?php

session_start();

date_default_timezone_set('America/Recife');

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/settings.php';

$app = new \Slim\App($settings);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['connections'][$container['default']]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ . '/../app/routes.php';
