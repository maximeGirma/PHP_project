<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 19/01/18
 * Time: 11:26
 */

function crud_display_update_interface(){

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

function crud_update(){

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

