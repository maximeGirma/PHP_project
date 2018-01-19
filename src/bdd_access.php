<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 19/01/18
 * Time: 12:12
 */



function bdd_acces($query)
{

    try {
        $db = new  PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    } catch (PDOException $e) { //on catch, on type ce qu'on à attrapé et on le stocke dans e
        echo '<strong>PDO Exception</strong><br />', $e->
        getMessage();
        die();
    }

    $statement = $db->prepare($query);
    if ($statement->execute()) {

        return $statement;
    } else {

        return FALSE;
    }


}