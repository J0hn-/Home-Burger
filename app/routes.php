<?php

// Home page
$app->get('/', function () use ($app) {
    $burgers = $app['dao.burger']->findAll();
    return $app['twig']->render('index.html.twig', array('burgers' => $burgers));
});
