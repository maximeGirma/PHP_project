<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 18/01/18
 * Time: 18:51
 */
require_once '../config.inc.php';
require_once 'session.php';
require_once 'error.php';
require_once 'connexion.php';
require_once 'connect.php';
require_once 'requete_operator.php';
require_once 'CRUD_interface.php';
session_start();



if(!is_connected())
{
    end_session();
    if(!isset($_POST['ID']) || !isset($_POST['PSW']))display_connect_page();
    else{
        $infos_utilisateur = connexion();
        if($infos_utilisateur==FALSE)display_connect_page('error');
        init_session($infos_utilisateur);
    }
}




if(isset($_POST['interface_choice'])){
    switch ($_POST['interface_choice']){
        case 1: if($_SESSION['id_type_utilisateur']>= 1)operator_interface();
            break;
        case 2:echo 'yep...<br/>Euh...Comment dire...<br/>C\'est pas finis finis quoi...';
            break;
        case 3:if($_SESSION['id_type_utilisateur']>= 3)crud_interface();
            break;
        default:
            save_error("index.php->ligne 19 to 29 : error interface_choice");
            error_alert();
            end_session();
            header('Location: connect.php');
    }

}else{
    switch ($_SESSION['id_type_utilisateur']){
        case 1: if($_SESSION['id_type_utilisateur']>= 1)operator_interface();
            break;
        case 2:echo 'yep...<br/>Euh...Comment dire...<br/>C\'est pas finis finis quoi...';
            break;
        case 3:if($_SESSION['id_type_utilisateur']>= 3)crud_interface();
            break;
        default:
            save_error("index.php->ligne 31 to 39 : error id_type_utilisateur");
            error_alert();
            end_session();
           echo'pouet';// header('Location: connect.php');
    }
}