<?php

namespace HomeBurger\DAO;

use HomeBurger\Domain\Category;

class CategoryDAO extends DAO
{
    /**
     * Return a list of all categories, sorted by ID, in ascending order.
     *
     * @return array A list of all categories.
     */
    public function findAll() {
        $sql = "select * from t_cat order by cat_id asc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categoryId = $row['cat_id'];
            $categories[$categoryId] = $this->buildDomainObject($row);
        }
        return $categories;
    }

    /**
     * Returns a category matching the supplied id.
     *
     * @param integer $id
     *
     * @return \HomeBurger\Domain\Category|throws an exception if no matching category is found
     */
    public function find($id) {
        $sql = "select * from t_cat where cat_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No category matching id " . $id);
    }

    /**
     * Creates a Category object based on a DB row.
     *
     * @param array $row The DB row containing category data.
     * @return \HomeBurger\Domain\Category
     */
    protected function buildDomainObject($row) {
        $category = new Category();
        $category->setId($row['cat_id']);
        $category->setName($row['cat_name']);
        return $category;
    }
}
