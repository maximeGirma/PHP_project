
<?php

function init_session($id_utilisateur="", $id_type_utilisateur="", $prenom_utilisateur="", $nom_utilisateur=""){

	$a = session_id();
	if(empty($a)) session_start();
	
	$_SESSION['id_utilisateur'] = $id_utilisateur;
	$_SESSION['id_type_utilisateur'] = $id_type_utilisateur;
	$_SESSION['prenom_utilisateur'] = $prenom_utilisateur;
	$_SESSION['nom_utilisateur'] = $nom_utilisateur;
	$_SESSION['connected'] = TRUE;

	//echo 'Bienvenue ' . $_SESSION['prenom_utilisateur'] . $_SESSION['nom_utilisateur'], '.';
	//echo "SID: ".SID."<br>session_id(): ".session_id()."<br>COOKIE: ".$_COOKIE["PHPSESSID"];

}

function is_connected(array $type_user_allowed){

    session_start();

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