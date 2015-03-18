<?php

namespace HomeBurger\Domain;

class Burger
{
    /**
     * Burger id.
     *
     * @var integer
     */
    private $id;

    /**
     * Burger name.
     *
     * @var string
     */
    private $name;

    /**
     * Burger resume.
     *
     * @var string
     */
    private $resume;

	/**
     * Burger IMGpath.
     *
     * @var string
     */
    private $IMGpath;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getResume() {
        return $this->resume;
    }

    public function setResume($resume) {
        $this->resume = $resume;
    }

	public function getIMGpath() {
        return $this->IMGpath;
    }

	public function setIMGpath($IMGpath) {
        $this->IMGpath = $IMGpath;
    }
}
