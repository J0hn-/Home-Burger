<?php

use Symfony\Component\HttpFoundation\Request;
use HomeBurger\Domain\User;
use HomeBurger\Form\Type\UserType;

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

// Login form
$app->match('/login', function(Request $request) use ($app) {
    $categories = $app['dao.category']->findAll();
    $user = new User();
    $signupForm = $app['form.factory']->create(new UserType(), $user);
    $signupForm->handleRequest($request);
    if ($signupForm->isSubmitted() && $signupForm->isValid()) {
        $user->setRole("ROLE_USER");
        $user->setSalt(substr(md5(time()), 0, 23));
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
            $app['dao.user']->save($user);
            //$app['session']->getFlashBag()->add('success', 'Your comment was succesfully added.');
        }
        $signupFormView = $signupForm->createView();
    return $app['twig']->render('login.html.twig', array(
        'categories'    => $categories,
        'signupForm'    => $signupFormView,
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username')));
})->bind('login');  // named route so that path('login') works in Twig templates
