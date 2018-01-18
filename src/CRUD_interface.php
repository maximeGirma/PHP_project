<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 12/01/18
 * Time: 14:51
 */

function crud_interface()
{


    include("pages_html/CRUD_display.php");
    require_once 'display.php';



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

    function display_query_result($statement, $optionnal_string = "", $optionnal_string_2 = "")
    {
        $cols_id_activator = TRUE;
        while ($item = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo '<form action="index.php" method="post">';
            echo '<table>';
            echo '<tr>';
            if ($cols_id_activator) {
                foreach ($item as $key => $element) {
                    echo '<th>' . $key . '</th>';
                }
                $cols_id_activator = false;
            }
            echo '</tr> <tr>';
            foreach ($item as $key => $value) {

                if ($key == 'id_utilisateur') {
                    echo '<input name="modifier" type="hidden" value = "' . $value . '">';
                }
                echo '<td>';

                echo $value;
                echo '</td>';

            }
            echo '<td>';


            echo $optionnal_string;
            echo '</td>';
            echo '</tr>';
            echo '</table></form>';

        }
        echo $optionnal_string_2;
    }


    display_interface($crud_form_1);

    if (isset($_POST['afficher'])) {

        $display_query = "    
        SELECT 
        `id_utilisateur`,`nom_utilisateur`,`prenom_utilisateur` 
        FROM
        utilisateur
        WHERE id_type_utilisateur =";


        if (strlen($_POST['afficher']) == 1) {
            if ($statement = bdd_acces($display_query . $_POST['afficher'] . ';')) {
                $update_button = '<input type="submit" name ="button" value = "Modifier">';
                $create_button = '
                                <form action="index.php" method="post">
                                <input type="hidden" name="create" value="1"/>
                                <input type="submit" name ="button" value = "Ajouter Utilisateur"/>
                                </form>';
                display_query_result($statement, $update_button, $create_button);
            }
        }
    }
    if (isset($_POST['modifier'])) {

        $display_query_update = "    
        SELECT 
        `id_utilisateur`,`nom_utilisateur`,`prenom_utilisateur` 
        FROM
        utilisateur
        WHERE id_utilisateur =";

        $modifier = $_POST['modifier'];

        if ($statement = bdd_acces($display_query_update . $modifier . ';')) {
            display_query_result($statement);

            $statement->execute();
            $item = $statement->fetchObject();

            echo '<form action="index.php" method="post">
            <label for="nom">nom : </label>
            <input name="nom" type="text" required value="' . $item->nom_utilisateur . '">
            <label for="prenom">prenom : </label>
            <input name="prenom" type="text" required value="' . $item->prenom_utilisateur . '">
            <br/>
            <label for="new_ID">nouveau login: </label>
            <input name="new_ID" type="text" required>
            <label for="new_PSW">nouveau mot de passe: </label>
            <input name="new_PSW" type="password" required>
            <label for="id_type_user">type d\'utilisateur</label>
            <br/>
            <input type="radio"  name="id_type_user" value="1"><label>Opérateurs</label>
            <br/>
            <input type="radio"  name="id_type_user" value="2"><label>Gestionnaires</label>
            <br/>
            <input type="radio"  name="id_type_user" value="3"><label>Administrateurs</label>
            <input name="update" type="hidden" value = "1">
            <input name="id_utilisateur" type="hidden" value = "' . $item->id_utilisateur . '">
            <input type="submit" value="Modifier">
            </form>
            <form action="index.php" method="post">
            <input name="delete" type="hidden" value = "1">
            <input name="id_utilisateur" type="hidden" value = "' . $item->id_utilisateur . '">
            <input type="submit" value="supprimer utilisateur">
            </form>';


        }


    }

    if (isset($_POST['update'])) {
        $update_query = '
    UPDATE 
      `utilisateur` 
    SET 
      `nom_utilisateur`= \'' . $_POST['nom'] . '\',
      `prenom_utilisateur`= \'' . $_POST['prenom'] . '\',
      `login`= \'' . $_POST['new_ID'] . '\',
      `password_utilisateur`= \'' . $_POST['new_PSW'] . '\',
      `id_type_utilisateur`= \'' . $_POST['id_type_user'] . '\' 
    WHERE 
      `id_utilisateur`= \'' . $_POST['id_utilisateur'] . '\';';

        if ($statement = bdd_acces($update_query)) {

            echo '<p>modification effectuée !</p>';
            echo '<a href="CRUD_interface.php">Revenir à l\'interface administrateur</a>';

        } else echo 'ERREUR : La modification n\'a pas pu etre effectuée';
    }


    if (isset($_POST['create']) && $_POST['create'] == 1) {
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

    if (isset($_POST['create']) && $_POST['create'] == 2) {

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

    if (isset($_POST['delete']) && $_POST['delete'] == 1) {
        $delete_query =
            '
        DELETE 
        FROM 
        `utilisateur` 
        WHERE 
        id_utilisateur =\'' . $_POST['id_utilisateur'] . '\';';

        if (bdd_acces($delete_query)) {
            echo 'user deleted';
        } else {
            echo 'pause?';
        }
    }

}