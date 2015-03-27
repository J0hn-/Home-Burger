<?php

use Symfony\Component\HttpFoundation\Request;

// Home page
$app->get('/', function () use ($app) {
    $burgers = $app['dao.burger']->findAll();
    return $app['twig']->render('index.html.twig', array('burgers' => $burgers));
});

// Detailed info about a burger
$app->get('/burger/{id}', function ($id) use ($app) {
    $burger = $app['dao.burger']->find($id);
    return $app['twig']->render('burger.html.twig', array('burger' => $burger));
});

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');  // named route so that path('login') works in Twig templates
