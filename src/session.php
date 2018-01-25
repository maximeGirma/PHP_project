<?php
/*
 * Created by IntelliJ IDEA.
 * User: Maxime
 * Date: 18/01/18
 * Time: 18:51
 * Version 0.9
 * session.php contient les différentes fonctions relatives aux session
 * Voir les cartouches commentaires de chaque fonction
 * TODO: Supprimer end_session() au profit d'un simple session_destroy()
 */


function init_session(array $infos_utilisateur) {
/*
 * Created by IntelliJ IDEA.
 * User: Peter
 * Date: 18/01/18
 * Time: 18:51
 * Version 1
 *
 * init_session() est appelé par index.php. Elle prend en argument un tableau de string qu'elle
 */
	$SID = session_id();
	
	if(empty($SID)) {
		session_start();
	}
		
	//echo 'Bienvenue ' . $_SESSION['prenom_utilisateur'] . $_SESSION['nom_utilisateur'], '.';
	//echo "SID: ".SID."<br>session_id(): ".session_id()."<br>COOKIE: ".$_COOKIE["PHPSESSID"];
    $id_utilisateur = $infos_utilisateur[0];
	$id_type_utilisateur=$infos_utilisateur[1];
	$prenom_utilisateur=$infos_utilisateur[2];
	$nom_utilisateur=$infos_utilisateur[3];

	$_SESSION['id_utilisateur'] = $id_utilisateur;
	$_SESSION['id_type_utilisateur'] = $id_type_utilisateur;
	$_SESSION['prenom_utilisateur'] = $prenom_utilisateur;
	$_SESSION['nom_utilisateur'] = $nom_utilisateur;
	$_SESSION['started_time'] = time();
	$_SESSION['timeout'] = 600;
	$_SESSION['connected'] = TRUE;
	$_SESSION['tracker'] = 0;

}

function update_timeout()
{
    $_SESSION['started_time'] = time();
}

function timeout_session()
{
	
	if(time() > $_SESSION['started_time'] + $_SESSION['timeout'])	{
		$_SESSION['connected'] = FALSE;
		return TRUE;
	}	
}


function is_connected(){



    if(isset($_SESSION['connected']))
    {

        if(timeout_session())return FALSE;

        if ($_SESSION['connected'] != TRUE)
        {
            return FALSE;

        }else return TRUE;


    }else return FALSE;
}

function end_session()
{

    session_destroy();
}

