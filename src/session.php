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
	
	if(time() > $_SESSION['started_time'] + $_SESSION['timeout'])	{
		$_SESSION['connected'] = FALSE;
		header('Location: end_session.php');
	}	
}


function is_connected(array $type_user_allowed){


    if(isset($_SESSION['connected']))
    {
        if ($_SESSION['connected'] != TRUE){
            header("Location: connect.html");
        }
        $compteur = 0;
        foreach ($type_user_allowed as $element) {
            if ($element == $_SESSION['id_type_utilisateur']) {
                $compteur++;
            }
        }
        if ($compteur == 0){
            header("Location: connect.html");
        }

    }else header("Location: connect.html");
}
