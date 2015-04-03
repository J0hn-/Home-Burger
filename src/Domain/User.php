<?php

namespace HomeBurger\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    private $id;

    /**
     * User mail.
     *
     * @var string
     */
    private $mail;

    /**
     * User lastname.
     *
     * @var string
     */
    private $lastname;

    /**
     * User firstname.
     *
     * @var string
     */
    private $firstname;

    /**
     * User address.
     *
     * @var string
     */
    private $address;

    /**
     * User postalcode.
     *
     * @var integer
     */
    private $postalcode;

    /**
     * User town.
     *
     * @var string
     */
    private $town;

    /**
     * User password.
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->mail;
    }

    public function setUsername($mail) {
        $this->mail = $mail;
    }

    /**
     * For easier comprehension we'll call getMail() instead of getUsername() in our code even if they have the same function
     */
    public function getMail() {
        return $this->mail;
    }

    /**
     * For easier comprehension we'll call setMail() instead of setUsername() in our code even if they have the same function
     */
    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getPostalcode() {
        return $this->postalcode;
    }

    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }

    public function getTown() {
        return $this->town;
    }

    public function setTown($town) {
        $this->town = $town;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}
