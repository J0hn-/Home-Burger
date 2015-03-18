<?php

// Return all articles
function getBurgers() {
    $bdd = new PDO('mysql:host=localhost;dbname=homeburger;charset=utf8', 'homeburger_user', 'secret');
	$burgers = $bdd->query('select * from t_brg order by brg_id asc');
    return $burgers;
}