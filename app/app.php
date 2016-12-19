<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'login' => array(
            'pattern' => '^/admin/login$',
        ),
        'secured' => array(
            'pattern' => '^/(admin|login_check|logout)',
            'logout' => true,
            'form' => array('login_path' => '/admin/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new EmineHakan\DAO\UserDAO($app['db']);
            }),
        ),
    ),
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

// Register services.
$app['dao.article'] = function ($app) {
    return new EmineHakan\DAO\ArticleDAO($app['db']);
};
$app['dao.user'] = $app->share(function ($app) {
    return new EmineHakan\DAO\UserDAO($app['db']);
});
