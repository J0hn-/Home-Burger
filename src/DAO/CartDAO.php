<?php

namespace HomeBurger\DAO;

use HomeBurger\Domain\Cart;

class CartDAO extends DAO
{
    /**
     * @var \HomeBurger\DAO\UserDAO
     */
    private $userDAO;

    /**
     * @var \HomeBurger\DAO\BurgerDAO
     */
    private $burgerDAO;

    public function setBurgerDAO(BurgerDAO $burgerDAO) {
        $this->burgerDAO = $burgerDAO;
    }

    public function setUserDAO(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    /**
     * Saves an new article into the user's cart.
     *
     * @param \MicroCMS\Domain\Cart $cart The new entrie to save
     */
    public function save(Cart $cart) {
        $cartData = array(
            'usr_id' => $cart->getUser()->getId(),
            'brg_id' => $cart->getBurger()->getId(),
            'quantity' => $cart->getQuantity()
            );

        if ($cart->getId()) {
            // The entry has already been saved : update it
            $this->getDb()->update('t_cart', $cartData, array('cart_id' => $cart->getId()));
        } else {
            // The entry has never been saved : insert it
            $this->getDb()->insert('t_cart', $cartData);
            // Get the id of the newly created entry and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $cart->setId($id);
        }
    }

    /**
     * Return a list of all article in a cart for a user.
     *
     * @param integer $userId The user id.
     *
     * @return array A list of all articles in the Cart.
     */
    public function findAllByUser($userId) {
        // The associated user is retrieved only once
        $user = $this->userDAO->find($userId);

        // The user won't be retrieved during domain objet construction
        $sql = "select * from t_cart where usr_id=? order by cart_id";
        $result = $this->getDb()->fetchAll($sql, array($userId));

        // Convert query result to an array of domain objects
        $carts = array();
        foreach ($result as $row) {
            $cartId = $row['cart_id'];
            $cart = $this->buildDomainObject($row);
            // The associated user is defined for the constructed cart
            $cart->setUser($user);
            $carts[$cartId] = $cart;
        }
        return $carts;
    }

    /**
     * Creates an Cart object based on a DB row.
     *
     * @param array $row The DB row containing Cart data.
     * @return \HomeBurger\Domain\Cart
     */
    protected function buildDomainObject($row) {
        $cart = new Cart();
        $cart->setId($row['cart_id']);
        $cart->setQuantity($row['quantity']);

        if (array_key_exists('usr_id', $row)) {
            // Find and set the associated article
            $userId = $row['usr_id'];
            $user = $this->userDAO->find($userId);
            $cart->setUser($user);
        }

        if (array_key_exists('brg_id', $row)) {
            // Find and set the associated article
            $burgerId = $row['brg_id'];
            $burger = $this->burgerDAO->find($burgerId);
            $cart->setBurger($burger);
        }

        return $cart;
    }
}
