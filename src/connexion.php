<?php


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
            echo 'echec requete';
        }
    }else 'pouet';
}
