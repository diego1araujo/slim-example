<?php

$settings = require __DIR__ . '/settings.php';

$app = new \Slim\App($settings);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['connections'][$container['default']]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['view'] = function ($c) {
    $settings = $c->get('settings')['view'];
    $view = new \Slim\Views\Twig($settings['path'], [
        'cache' => $settings['cache'],
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
