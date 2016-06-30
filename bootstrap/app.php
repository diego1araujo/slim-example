<?php

session_start();

date_default_timezone_set("America/Recife");

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver'     => 'mysql',
            'host'       => 'localhost',
            'database'   => '',
            'username'   => 'root',
            'password'   => '',
            'charset'    => 'utf8',
            'collaction' => 'utf8_general_ci',
            'prefix'     => '',
        ]
    ]
]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../views', [
        'cache' => false
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container->view);
};

require __DIR__ . '/../app/routes.php';
