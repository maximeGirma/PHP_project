<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 18/01/18
 * Time: 18:51
 */

require_once 'pages_html/welcome_page.php';
require_once '../config.inc.php';
require_once 'session.php';
require_once 'error.php';
require_once 'connexion.php';
require_once 'connect.php';
require_once 'requete_operator.php';
require_once 'CRUD_interface.php';
require_once 'bdd_access.php';
require_once 'gestionnaire.php';
require_once 'display.php';


session_start();

if(is_connected() == False)
{
    end_session();
    if(!isset($_POST['ID']) || !isset($_POST['PSW']))display_connect_page();
    else{
        $infos_utilisateur = connexion();
        if($infos_utilisateur==FALSE)display_connect_page('error');
        else init_session($infos_utilisateur);
    }
}

if (is_connected() == True){

    if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 1) {

        session_destroy();
        display_connect_page();

    }else {
        update_timeout();
        if (isset($_POST['interface_choice'])) {
            switch ($_POST['interface_choice']) {
                case 1:
                    if ($_SESSION['id_type_utilisateur'] >= 1) operator_interface();
                    break;
                case 2:
                    if ($_SESSION['id_type_utilisateur'] >= 2) gestionnaire();
                    break;
                case 3:
                    if ($_SESSION['id_type_utilisateur'] >= 3) crud_interface();
                    break;
                default:
                    save_error("index.php->ligne 19 to 29 : error interface_choice");
                    error_alert();
                    end_session();

            }
        }
        elseif ($_SESSION['tracker'] == 1 && $_SESSION['id_type_utilisateur'] >= 1) operator_interface();
        elseif ($_SESSION['tracker'] == 2 && $_SESSION['id_type_utilisateur'] >= 2) gestionnaire();
        elseif ($_SESSION['tracker'] == 3 && $_SESSION['id_type_utilisateur'] >= 3) crud_interface();


        else {

            display_interface($welcome_page);

        }
    }

}
