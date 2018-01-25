<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 19/01/18
 * Time: 10:56
 * Version 0.9
 * crud_delete() est appelé par la fonction crud_interface(). Il efface de la base l'utilisateur
 * correspondant à l'ID renseigné par l'administrateur.
 * Renvoie un str informant du succes ou de l'echec de la requete
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
        return 'Utilisateur supprimé avec succès';
    } else {
        return 'Une erreur s\'est produite, echec lors de la suppression';
    }
}