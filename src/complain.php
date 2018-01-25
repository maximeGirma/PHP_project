<?php
/**
 * Created by IntelliJ IDEA.
 * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 25/01/18
 * Time: 19:24
 * Version 0.1
 * save_complain est appelé par inedx.php et sauvegarde dans la bdd un message envoyé par le client
 * grace à la page de contact.
 */

function save_complain()
{

    $compteur = 0;

    /*while ($compteur < strlen($_POST['user_message']) && $compteur < 100)
    {   if(strlen($_POST['user_name'])< $compteur)
        {

            if (!preg_match('r^[a-zA-Z]', $_POST['user_name'][$compteur])) $_POST['user_name'][$compteur] = '_';
        }
        if(strlen($_POST['user_mail'])< $compteur)
        {

            if (!preg_match('r^[a-zA-Z]', $_POST['user_mail'][$compteur])) $_POST['user_mail'][$compteur] = '_';
        }
        if(strlen($_POST['statut'])< $compteur)
        {

            if (!preg_match('r^[a-zA-Z]', $_POST['statut'][$compteur])) $_POST['statut'][$compteur] = '_';
        }

        if(strlen($_POST['user_message'])< $compteur)
        {

            if (!preg_match('r^[a-zA-Z]', $_POST['user_message'][$compteur])) $_POST['user_message'][$compteur] = '_';
        }
        $compteur++;
    }*/
    $complain_query = "INSERT INTO message_contact(`message`) VALUES ('";
    $complain_query .= $_POST['user_name'].' || '.$_POST['user_email'].' || '.$_POST['statut'].' || '.$_POST['user_message'];
    $complain_query .= "')";
    echo $complain_query;
    bdd_acces($complain_query);
}