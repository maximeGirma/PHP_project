<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 19/01/18
 * Time: 11:27
 * Version 1
 * crud_select() est appelé par crud_interface. Il selectionne dans la base de données
 * les données relatives à tous les utilisateurs d'un groupe donné. Le choix du groupe est renseigné
 * par l'utilisateur à l'aide d'un $_POST.
 * Puis il formate les données à l'aide de display_query_result() et les renvoie. sinon renvoie false.
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
                                    <input id="query_name" type="submit" name ="button" value = "Ajouter Utilisateur"/>
                                    </form>';
            return display_query_result($statement, $update_button, $create_button);





        }else return False;
    }

}