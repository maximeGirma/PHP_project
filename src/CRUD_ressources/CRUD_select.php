<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 19/01/18
 * Time: 11:27
 */

function crud_select(){

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