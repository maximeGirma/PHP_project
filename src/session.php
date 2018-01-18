<?php

function init_session(array $infos_utilisateur) {

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
}


function timeout_session(){
	
	if(time() > $_SESSION['started_time'] + $_SESSION['timeout'])	{
		$_SESSION['connected'] = FALSE;
		return TRUE;
	}	
}


function is_connected(){

    if(timeout_session())return FALSE;

    if(isset($_SESSION['connected']))
    {
        if ($_SESSION['connected'] != TRUE)
        {
            return FALSE;

        }else return TRUE;


    }else return FALSE;
}

function end_session()
{
    session_unset();
    session_destroy();
}

