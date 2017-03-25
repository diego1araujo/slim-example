<?php

session_start();

date_default_timezone_set('America/Recife');

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/settings.php';

$app = new \Slim\App($settings);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['connections'][$container['default']]);
$capsule->bootEloquent();
$capsule->setAsGlobal();

$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => __DIR__ . '/../resources/cache',
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $c->router,
        $c->request->getUri()
    ));

    return $view;
};

$container['validator'] = function ($container) {
    return new \App\Validator;
};

$container['HomeController'] = function ($c) {
    return new \App\Controllers\HomeController($c->view);
};

$container['UserController'] = function ($c) {
    return new \App\Controllers\UserController($c->view, $c->validator);
};

require __DIR__ . '/../app/routes.php';
