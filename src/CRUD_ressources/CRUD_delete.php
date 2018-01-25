<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 19/01/18
 * Time: 10:56
 * Version 0.9
 * crud_delete() est appelé par la fonction crud_interface(). Il efface de la base l'utilisateur
 * correspondant à l'ID renseigné par l'administrateur.
 * TODO: Renvoi True / False
 */

function crud_delete(){

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