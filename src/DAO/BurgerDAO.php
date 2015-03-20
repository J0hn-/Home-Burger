<?php

namespace HomeBurger\DAO;

use Doctrine\DBAL\Connection;
use HomeBurger\Domain\Burger;

class BurgerDAO
{
    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Return a list of all burgerss, sorted by ID, in ascending order.
     *
     * @return array A list of all burgers.
     */
    public function findAll() {
        $sql = "select * from t_brg order by brg_id asc";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $burgers = array();
        foreach ($result as $row) {
            $burgerId = $row['brg_id'];
            $burgers[$burgerId] = $this->buildBurger($row);
        }
        return $burgers;
    }

    /**
     * Creates an Burger object based on a DB row.
     *
     * @param array $row The DB row containing Burger data.
     * @return \HomeBurger\Domain\Burger
     */
    private function buildBurger(array $row) {
        $burger = new Burger();
        $burger->setId($row['brg_id']);
        $burger->setName($row['brg_name']);
        $burger->setResume($row['brg_resume']);
		$burger->setIMGpath($row['brg_img_path']);
        return $burger;
    }
}
