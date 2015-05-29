<?php

use Symfony\Component\HttpFoundation\Request;
use HomeBurger\Domain\User;
use HomeBurger\Domain\Cart;
use HomeBurger\Form\Type\UserType;
use HomeBurger\Form\Type\CartType;

// Home page
$app->get('/', function () use ($app) {
    $categories = $app['dao.category']->findAll();
    $user = $app['security']->getToken()->getUser();
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY'))
      $carts = $app['dao.cart']->findAllByUser($user->getId());
    else
      $carts = array();
    return $app['twig']->render('index.html.twig', array(
      'categories' => $categories,
      'carts' => $carts
      ));
});

// Detailed info about a burger
$app->get('/cat/{id}', function ($id) use ($app) {
    $categories = $app['dao.category']->findAll();
    $user = $app['security']->getToken()->getUser();
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY'))
      $carts = $app['dao.cart']->findAllByUser($user->getId());
    else
      $carts = array();
    $category = $app['dao.category']->find($id);
    $burgers = $app['dao.burger']->findByCategory($id);
    return $app['twig']->render('listing.html.twig', array(
      'categories' => $categories,
      'burgers' => $burgers,
      'category' => $category,
      'carts' => $carts
    ));
});

// Detailed info about a burger
$app->match('/burger/{id}', function ($id, Request $request) use ($app) {
    $categories = $app['dao.category']->findAll();
    $user = $app['security']->getToken()->getUser();
    $burger = $app['dao.burger']->find($id);
    $category = $app['dao.category']->find($burger->category);
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY'))
      $carts = $app['dao.cart']->findAllByUser($user->getId());
    else
      $carts = array();

    $cart = new Cart();
    $cartForm = $app['form.factory']->create(new CartType(), $cart);
    $cartForm->handleRequest($request);//Marc est con

    if($cartForm->isValid() && $cartForm->isSubmitted())
    {
        // On vérifie que la quantité est positive
        if($cart->getQuantity() < 1) {
            $app['session']->getFlashBag()->add('success', 'Quantité invalide !');
            return $app->redirect('/burger/'.$id);
        }
        else {
            $cartBD = $app['dao.cart']->findByUserAndBurger($user->getId(), $burger->getID());
            $cart->setUser($user);
            $cart->setId($cartBD->getId());
            $cart->setBurger($burger);
            $cart->setQuantity($cartBD->getQuantity() + $cart->getQuantity());
            $app['dao.cart']->save($cart);

            return $app->redirect('/cart');
        }
    }

    $cartFormView = $cartForm->createView();

    return $app['twig']->render('burger.html.twig', array(
      'categories' => $categories,
      'cartForm' => $cartFormView,
      'category' => $category,
      'burger' => $burger,
      'carts' => $carts
      ));
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

// Update form
$app->match('/profile', function(Request $request) use ($app) {
    $categories = $app['dao.category']->findAll();
    $user = $app['security']->getToken()->getUser();
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY'))
      $carts = $app['dao.cart']->findAllByUser($user->getId());
    else
      $carts = array();
    $updateForm = $app['form.factory']->create(new UserType(), $user);
    $updateForm->handleRequest($request);
    if ($updateForm->isSubmitted() && $updateForm->isValid()) {
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
    $updateFormView = $updateForm->createView();
    return $app['twig']->render('profile.html.twig', array(
        'categories'    => $categories,
        'user'          => $user,
        'updateForm'    => $updateFormView,
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
        'carts' => $carts
        ));
})->bind('profile');  // named route so that path('profile') works in Twig templates

// Cart overview
$app->get('/cart', function () use ($app) {
    $categories = $app['dao.category']->findAll();
    $user = $app['security']->getToken()->getUser();
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY'))
      $carts = $app['dao.cart']->findAllByUser($user->getId());
    else
      $carts = array();
    return $app['twig']->render('cart.html.twig', array(
      'categories' => $categories,
      'carts' => $carts));
});

// Adding burger to cart
$app->get('/cart/add/{id}', function ($id) use ($app) {
    $burger = $app['dao.burger']->find($id);
    $user = $app['security']->getToken()->getUser();
    $cart = $app['dao.cart']->findByUserAndBurger($user->getId(),$burger->getID());
    $cart->setUser($user);
    $cart->setBurger($burger);
    $cart->setQuantity($cart->getQuantity()+1);
    $app['dao.cart']->save($cart);
    $app['session']->getFlashBag()->add('success', 'Your burger was succesfully added.');

    return $app->redirect('/cart');
});

// Remove from cart
$app->get('/cart/remove/{id}', function ($id) use ($app) {
    $app['dao.cart']->delete($id);
    $app['session']->getFlashBag()->add('success', 'Your burger was succesfully removed.');

    return $app->redirect('/cart');
});

// Edit quantity from cart
$app->get('/cart/edit/plus/{id}', function ($id) use ($app) {
    $cart = $app['dao.cart']->find($id);
    $cart->setQuantity($cart->getQuantity()+1);
    $app['dao.cart']->save($cart);
    $app['session']->getFlashBag()->add('success', 'Quantity was succesfully updated.');

    return $app->redirect('/cart');
});

// Remove from cart
$app->get('/cart/edit/minus/{id}', function ($id) use ($app) {
  $cart = $app['dao.cart']->find($id);
  if ($cart->getQuantity() == 1)
      return $app->redirect('/cart/remove/'.$id);
  $cart->setQuantity($cart->getQuantity()-1);
  $app['dao.cart']->save($cart);
  $app['session']->getFlashBag()->add('success', 'Quantity was succesfully updated.');

  return $app->redirect('/cart');
});
