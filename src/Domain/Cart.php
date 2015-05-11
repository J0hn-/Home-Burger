<?php

namespace HomeBurger\Domain;

class Cart
{
    /**
     * Cart id.
     *
     * @var integer
     */
    private $id;

    /**
     * Associated user.
     *
     * @var \HomeBurger\Domain\User
     */
    private $user;

    /**
     * Associated burger.
     *
     * @var \HomeBurger\Domain\Burger
     */
    private $burger;


    /**
     * Cart quantity.
     *
     * @var integer
     */
    private $quantity;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function getBurger() {
        return $this->burger;
    }

    public function setBurger(Burger $burger) {
        $this->burger = $burger;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
}
