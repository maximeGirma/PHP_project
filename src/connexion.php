<?php

require_once '../config.inc.php';



if(isset ($_POST['ID']) && isset($_POST['PSW'])){


	try{
		$db = new  PDO('mysql:host='.DB_HOST. ';dbname='. DB_NAME, DB_USER, DB_PASS);
	}

	catch (PDOException $e) { //on catch, on type ce qu'on à attrapé et on le stocke dans e
        echo '<strong>PDO Exception</strong><br />', $e->
        getMessage();
        die();
    }

    $username = crypt($_POST['ID'],'USERNAME');
	$password = crypt($_POST['PSW'],'PASSWORD');

    $loginQuery ="
	SELECT 
		id_type_utilisateur 
	FROM 
		utilisateur
	WHERE
		'$username' = utilisateur.login AND '$password' = utilisateur.password_utilisateur;";

	$statement = $db->prepare($loginQuery);
	if($statement->execute()) {

		$item = $statement->fetchObject();
		if(isset($item->id_type_utilisateur)){
			switch($item->id_type_utilisateur){

				case 1 :
                    header('Location: pages_html/consultation_donnees.html');
					break;
				case 2:
					echo 'gestionnaire';
					break;
				case 3:
                    echo 'all praise the administrator! ';
                    exit();
					break;
				default:
					echo'something gone wrong...';
			}

		}else{echo'Echec lors de l\'identification';}
	}else{echo 'echec requete';}
}

