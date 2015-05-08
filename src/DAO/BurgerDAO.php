<?php

namespace HomeBurger\DAO;

use HomeBurger\Domain\Burger;

class BurgerDAO extends DAO
{
    /**
     * Return a list of all burgers, sorted by ID, in ascending order.
     *
     * @return array A list of all burgers.
     */
    public function findAll() {
        $sql = "select * from t_brg order by brg_id asc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $burgers = array();
        foreach ($result as $row) {
            $burgerId = $row['brg_id'];
            $burgers[$burgerId] = $this->buildDomainObject($row);
        }
        return $burgers;
    }

    /**
     * Returns a burger matching the supplied id.
     *
     * @param integer $id
     *
     * @return \HomeBurger\Domain\Burger|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_brg where brg_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No burger matching id " . $id);
    }

    /**
     * Return a list of all burgers, sorted by ID, in ascending order, matching the supplied category id.
     *
     * @param integer $id
     *
     * @return array A list of all burgers.
     */
    public function findByCategory($id) {
        $sql = "select * from t_brg where brg_cat=? order by brg_id asc";
        $result = $this->getDb()->fetchAll($sql, array($id));

        // Convert query result to an array of domain objects
        $burgers = array();
        foreach ($result as $row) {
            $burgerId = $row['brg_id'];
            $burgers[$burgerId] = $this->buildDomainObject($row);
        }
        return $burgers;
    }

    /**
     * Return a list of burgers from the user's cart.
     *
     * @param integer $id
     *
     * @return array A list of all burgers.
     */
    public function fromUserCart($id) {
        $sql = "select * from t_cart where usr_id=?";
        $result = $this->getDb()->fetchAll($sql, array($id));

        // Convert query result to an array of domain objects
        $burgers = array();
        $id = 0;
        foreach ($result as $row) {
            $burgerId = $row['brg_id'];
            $burgers[$id] = $this->find($burgerId);
            $id++;
        }
        return $burgers;
    }
    

    /**
     * Creates an Burger object based on a DB row.
     *
     * @param array $row The DB row containing Burger data.
     * @return \HomeBurger\Domain\Burger
     */
    protected function buildDomainObject($row) {
        $burger = new Burger();
        $burger->setId($row['brg_id']);
        $burger->setName($row['brg_name']);
        $burger->setResume($row['brg_resume']);
		    $burger->setIMGname($row['brg_img_name']);
        $burger->setCategory($row['brg_cat']);
        $burger->setPrice($row['brg_prix']);
        return $burger;
    }
}
