<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 12/01/18
 * Time: 14:51
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



    display_interface($crud_form_1);

    if (isset($_POST['afficher'])) crud_select();


    if (isset($_POST['modifier'])) crud_display_update_interface();


    if (isset($_POST['update'])) crud_update();

    if (isset($_POST['create']) && $_POST['create'] == 1) crud_display_create_interface();

    if (isset($_POST['create']) && $_POST['create'] == 2) crud_create();

    if (isset($_POST['delete']) && $_POST['delete'] == 1) crud_delete();


}