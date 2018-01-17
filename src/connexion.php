<?php
//sessionstart
require_once '../config.inc.php';
require_once 'session.php';



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
		id_utilisateur,
		id_type_utilisateur,
		prenom_utilisateur,
		nom_utilisateur
	FROM 
		utilisateur
	WHERE
		'$username' = utilisateur.login AND '$password' = utilisateur.password_utilisateur;";

	$statement = $db->prepare($loginQuery);
	if($statement->execute()) {


		$item = $statement->fetchObject();
		if(isset($item->id_type_utilisateur))
		{

            init_session($item->id_utilisateur,
                $item->id_type_utilisateur,
                $item->prenom_utilisateur,
                $item->nom_utilisateur);


		    switch($item->id_type_utilisateur){


				case 1 :
                    header('Location: requete_operator.php');
					break;
				case 2:
					echo 'gestionnaire';
					break;
				case 3:
                    header('Location: CRUD_interface.php');
                    exit();
					break;
				default:
					echo'something gone wrong...';
			}

		}else{header("Location:pages_html/error_connect.html");}

    }else{echo 'echec requete';}
}

