<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 19/01/18
 * Time: 10:56
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