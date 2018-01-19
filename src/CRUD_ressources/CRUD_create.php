<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 19/01/18
 * Time: 11:25
 */


function crud_display_create_interface(){


        echo '<center><form action="index.php" method="POST">
            <label for="nom">Nom : </label>
            <input name="nom" type="text" required>
            <label for="prenom">Prenom : </label>
            <input name="prenom" type="text" required >
            <br/>
            <label for="new_ID">Login: </label>
            <input name="new_ID" type="text" required>
            <label for="new_PSW">Mot de passe: </label>
            <input name="new_PSW" type="password" required>
            <br/>
            <label for="id_type_user">type d\'utilisateur</label>
            <br/>
            <input type="radio"  name="id_type_user" value="1"><label>Opérateurs</label>
            <br/>
            <input type="radio"  name="id_type_user" value="2"><label>Gestionnaires</label>
            <br/>
            <input type="radio"  name="id_type_user" value="3"><label>Administrateurs</label>
            <input name="create" type="hidden" value = "2">
            <br/>
            <input type="submit" value="Creer !"></center>';



}

function crud_create(){
    $check_username_query = '
        SELECT
            login
        FROM
            utilisateur
        WHERE
            utilisateur.login = \'' . $_POST['new_ID'] . '\';
        ';
    $statement = bdd_acces($check_username_query);
    $item=$statement->fetchObject();
    if (!$item->login) {


        $_POST['new_ID'] = crypt($_POST['new_ID'], 'USERNAME');
        $_POST['new_PSW'] = crypt($_POST['new_PSW'], 'PASSWORD');
        $create_query = '
            INSERT INTO 
              `utilisateur`( 
                `nom_utilisateur`, 
                `prenom_utilisateur`, 
                `login`, 
                `password_utilisateur`, 
                `id_type_utilisateur`) 
            VALUES 
              (
             \'' . $_POST['nom'] . '\',
              \'' . $_POST['prenom'] . '\',
              \'' . $_POST['new_ID'] . '\',
              \'' . $_POST['new_PSW'] . '\',
              \'' . $_POST['id_type_user'] . '\'
              );
            ';

        if (bdd_acces($create_query)) {
            echo 'oh yeah';
        } else echo 'oh no...';
    } else {
        echo 'Ce login est deja utilisé';
    }

}