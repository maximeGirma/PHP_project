
<?php

function init_session($id_utilisateur="", $id_type_utilisateur="", $prenom_utilisateur="", $nom_utilisateur="") {

	$SID = session_id();
	
	if(empty($SID)) {
		session_start();
	}
		
	//echo 'Bienvenue ' . $_SESSION['prenom_utilisateur'] . $_SESSION['nom_utilisateur'], '.';
	//echo "SID: ".SID."<br>session_id(): ".session_id()."<br>COOKIE: ".$_COOKIE["PHPSESSID"];

	
	$_SESSION['id_utilisateur'] = $id_utilisateur;
	$_SESSION['id_type_utilisateur'] = $id_type_utilisateur;
	$_SESSION['prenom_utilisateur'] = $prenom_utilisateur;
	$_SESSION['nom_utilisateur'] = $nom_utilisateur;
	$_SESSION['started_time'] = time();
	$_SESSION['timeout'] = 600;
	$_SESSION['connected'] = TRUE;
}


function timeout_session(){
	
	$_SESSION['started_time'] = time();
	$_SESSION['timeout'] = 600;
	$_SESSION['connected'] = TRUE;

	if(time() > $started_time + $timeout)	{
		$connected = FALSE;
		header('Location: end_session.php');
	}	
}
