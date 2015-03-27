<?php

// Home page
$app->get('/', function () use ($app) {
    $categories = $app['dao.category']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $categories));
});

// Detailed info about a burger
$app->get('/cat/{id}', function ($id) use ($app) {
    $categories = $app['dao.category']->findAll();
    $category = $app['dao.category']->find($id);
    $burgers = $app['dao.burger']->findByCategory($id);
    return $app['twig']->render('listing.html.twig', array(
      'categories' => $categories,
      'burgers' => $burgers,
      'category' => $category
    ));
});

// Detailed info about a burger
$app->get('/burger/{id}', function ($id) use ($app) {
    $categories = $app['dao.category']->findAll();
    $burger = $app['dao.burger']->find($id);
    return $app['twig']->render('burger.html.twig', array(
      'categories' => $categories,
      'burger' => $burger));
});
