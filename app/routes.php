<?php

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
