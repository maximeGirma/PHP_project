<?php
/*
 *  * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 20/01/18
 * Time: 16:10
 * Version 1
 * connexion() est appellée par index.php Elle récupere les super gloables $_POST['ID & PSW']
 * puis les crypte. Elle les compare ensuite à la aux id et psw stockés dans la BDD.(grace à bdd_acces()
 * Si les identifiants correspondent elle charge les infos permettant la création d'une session
 * et les retourne dans un tableau.
 * Sinon elle retourne un False
 */

function connexion()
{

    if (isset ($_POST['ID']) && isset($_POST['PSW'])) {


        try {
            $db = new  PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $e) { //on catch, on type ce qu'on à attrapé et on le stocke dans e
            echo '<strong>PDO Exception</strong><br />', $e->
            getMessage();
            die();
        }

        $username = crypt($_POST['ID'], 'USERNAME');
        $password = crypt($_POST['PSW'], 'PASSWORD');

        $loginQuery = "
        SELECT 
            id_utilisateur,
            id_type_utilisateur,
            prenom_utilisateur,
            nom_utilisateur
        FROM 
            utilisateur
        WHERE
            '$username' = utilisateur.login AND '$password' = utilisateur.password_utilisateur;";

        $statement = $db->prepare($loginQuery);
        if ($statement->execute()) {


            $item = $statement->fetchObject();
            if (isset($item->id_type_utilisateur)) {
                    return [$item->id_utilisateur,
                    $item->id_type_utilisateur,
                    $item->prenom_utilisateur,
                    $item->nom_utilisateur];


            } else return FALSE;

        } else {
            return False;
        }
    }else return False;
}
