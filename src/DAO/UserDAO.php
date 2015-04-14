<?php

namespace HomeBurger\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use HomeBurger\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \HomeBurger\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from t_usr where usr_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($email)
    {
        $sql = "select * from t_usr where usr_mail=?";
        $row = $this->getDb()->fetchAssoc($sql, array($email));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User identified by "%s" not found.', $email));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'HomeBurger\Domain\User' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \HomeBurger\Domain\User
     */
    protected function buildDomainObject($row) {
        $user = new User();
        $user->setId($row['usr_id']);
        $user->setMail($row['usr_mail']);
        $user->setLastname($row['usr_lastname']);
        $user->setFirstname($row['usr_firstname']);
        $user->setAddress($row['usr_address']);
        $user->setPostalcode($row['usr_postalcode']);
        $user->setTown($row['usr_town']);
        $user->setPassword($row['usr_password']);
        $user->setSalt($row['usr_salt']);
        $user->setRole($row['usr_role']);
        return $user;
    }

    /**
     * Saves a comment into the database.
     *
     * @param \MicroCMS\Domain\Comment $comment The comment to save
     */
    public function save(User $user) {
        $userData = array(
            'usr_id' => $user->getId(),
            'usr_mail' => $user->getMail(),
            'usr_lastname' => $user->getLastname(),
            'usr_firstname' => $user->getFirstname(),
            'usr_address' => $user->getAddress(),
            'usr_postalcode' => $user->getPostalcode(),
            'usr_town' => $user->getTown(),
            'usr_password' => $user->getPassword(),
            'usr_salt' => $user->getSalt(),
            'usr_role' => $user->getRole()
            );

        //$this->getDb()->insert('t_usr', $userData);

        $sql = "select * from t_usr where usr_mail=?";
        $row = $this->getDb()->fetchAssoc($sql, array($user->getMail()));

        if($row) {
          // Utilisateur déjà existant !
        } else {
            if ($user->getId()) {
                // The user has already been saved : update it
                $this->getDb()->update('t_usr', $userData, array('usr_id' => $user->getId()));
            } else {
                // The user has never been saved : insert it
                $this->getDb()->insert('t_usr', $userData);
                // Get the id of the newly created user and set it on the entity.
                $id = $this->getDb()->lastInsertId();
                $user->setId($id);
            }
        }
    }
}
