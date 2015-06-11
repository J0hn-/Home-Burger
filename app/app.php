<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new HomeBurger\DAO\UserDAO($app['db']);
            }),
        ),
    ),
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

// Register error handler
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 403:
            $message = 'Access denied.';
            break;
        case 404:
            $message = 'This is not the Burger you are looking for.';
            break;
        default:
            $message = "Something went wrong.";
    }
    $categories = $app['dao.category']->findAll();
    return $app['twig']->render('error.html.twig', array(
        'message' => $message,
        'categories' => $categories));
});

// Register services.
$app['dao.burger'] = $app->share(function ($app) {
    return new HomeBurger\DAO\BurgerDAO($app['db']);
});

$app['dao.category'] = $app->share(function ($app) {
    return new HomeBurger\DAO\CategoryDAO($app['db']);
});

$app['dao.user'] = $app->share(function ($app) {
    return new HomeBurger\DAO\UserDAO($app['db']);
});

$app['dao.cart'] = $app->share(function ($app) {
    $cartDAO = new HomeBurger\DAO\CartDAO($app['db']);
    $cartDAO->setUserDAO($app['dao.user']);
    $cartDAO->setBurgerDAO($app['dao.burger']);
    return $cartDAO;
});
