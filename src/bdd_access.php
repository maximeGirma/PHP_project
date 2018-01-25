<?php
/**
 * Created by IntelliJ IDEA.
 * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 19/01/18
 * Time: 12:12
 * Version 1.0
 * bdd_access est appellée par les différentes fonctions qui ont besoin d'acceder à la BDD.
 * Elle prend une requete SQL comme argument et renvoie le resultat renvoyé par la BDD ou un FALSE
 * si la requete à échoué.
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