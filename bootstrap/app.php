<?php

session_start();

date_default_timezone_set('America/Recife');

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/config.php';

$app = new \Slim\App($config);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->bootEloquent();
$capsule->setAsGlobal();

$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../views', [
        'cache' => false
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $c->router,
        $c->request->getUri()
    ));

    return $view;
};

$container['HomeController'] = function ($c) {
    return new \App\Controllers\HomeController($c->view);
};

$container['UserController'] = function ($c) {
    return new \App\Controllers\UserController($c->view);
};

require __DIR__ . '/../app/routes.php';
