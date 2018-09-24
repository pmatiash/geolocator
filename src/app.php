<?php

use MatiashApp\MatiashApp;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;

$app = new MatiashApp();

$app->register(new AssetServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(
    new TwigServiceProvider(),
    [
        'twig.path' => __DIR__.'/../views',
    ]
);
$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver'   => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'test',
        'user'      => 'test_user',
        'password'  => 'secret',
    ],
]);

$app->setConnection($app['db']);

$config = require __DIR__.'/../config/parameters.php';
$app->setConfig($config);

return $app;

