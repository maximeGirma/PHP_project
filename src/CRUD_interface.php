<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 12/01/18
 * Time: 14:51
 * Version 0.3
 * crud_interface() est appellé par index.php et appelle différentes fonctions d'administration
 * selon l'argument contenu dans des variables $_POST['']. Elle affiche ensuite le retour de ces
 * fonctions grâce au display_interface().
 */

function crud_interface()
{


    $_SESSION['tracker']=3;
    include("pages_html/CRUD_display.php");
    require_once 'display.php';
    require_once 'CRUD_ressources/CRUD_select.php';
    require_once 'CRUD_ressources/CRUD_update.php';
    require_once 'CRUD_ressources/CRUD_create.php';
    require_once 'CRUD_ressources/CRUD_delete.php';





    if (isset($_POST['afficher'])) display_interface($crud_form_1,crud_select());


    elseif (isset($_POST['modifier']))display_interface($crud_form_1,crud_display_update_interface());


    elseif (isset($_POST['update'])) display_interface($crud_form_1,crud_update());

    elseif (isset($_POST['create']) && $_POST['create'] == 1) display_interface(crud_display_create_interface());

    elseif (isset($_POST['create']) && $_POST['create'] == 2) display_interface($crud_form_1,crud_create());

    elseif (isset($_POST['delete']) && $_POST['delete'] == 1) display_interface($crud_form_1,crud_delete());

    else display_interface($crud_form_1);
}

