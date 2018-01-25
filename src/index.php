<?php
/**
 * Created by IntelliJ IDEA.
 * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 18/01/18
 * Time: 18:51
 * Version 0.9
 * index.php est la page principale de l'applicatif. Toutes les requetes clients -> serveur
 * passent par là. L'index verifie la connexion avant d'appeller les fonctions nécessaires au
 * fonctionnement du système, selon les requetes envoyées par le client.
 */

require_once 'pages_html/welcome_page.php';
require_once '../config.inc.php';
require_once 'session.php';
require_once 'error.php';
require_once 'connexion.php';
require_once 'connect.php';
require_once 'queries_operator.php';
require_once 'CRUD_interface.php';
require_once 'bdd_access.php';
require_once 'gestionnaire.php';
require_once 'display.php';
require_once 'complain.php';

session_start();

if(isset($_POST['user_message']))save_complain();


if(is_connected() == False)
{
    session_destroy();
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
                    session_destroy();

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
