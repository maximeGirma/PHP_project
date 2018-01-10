<?php 
/*REQUETE 6 POUR L'ANNE EN COURS (2018 DONC...)
SELECT
carte_abonnement.id_type_ab AS 'NO ABONNEMENT'
,type_abonnement.denom_ab AS 'TYPE ABONNEMENT'
,concat((
(sum(if( year(carte_abonnement.date_paiement) = @annee, if(prix_duplicata != 0, 0,
histo_tarif_abo.tarif),0)))
+
(sum(if(year(duplicata.date_duplicata) = @annee, duplicata.prix_duplicata, 0)))
-
(sum(if(year(resilie.date_resiliation) = @annee, if(prix_duplicata != 0, 0, resilie.montant_remb)
        ,0
)))),'€') AS 'CHIFFRE_D_AFFAIRE_TOTAL_SUR_L_ANNEE'
, @annee AS 'ANNEE'
from carte_abonnement
inner join type_abonnement on carte_abonnement.id_type_ab = type_abonnement.id_type_ab
inner join histo_tarif_abo on carte_abonnement.id_type_ab = histo_tarif_abo.id_type_ab
left join duplicata on carte_abonnement.id_abonnement = duplicata.id_abonnement
left join resilie on carte_abonnement.id_abonnement = resilie.id_abonnement
where (year(histo_tarif_abo.date_prise_effet) = @annee )
group by type_abonnement.id_type_ab

order by carte_abonnement.id_type_ab;
*/

//effectue des requetes SQL en fonction de l'argument recu


require_once '../config.inc.php';
require_once 'requetes_file.php';


try{
	$db = new  PDO('mysql:host='.DB_HOST. ';dbname='. DB_NAME, DB_USER, DB_PASS);
}

catch (PDOException $e){ //on catch, on type ce qu'on à attrapé et on le stocke dans e
	echo '<strong>PDO Exception</strong><br />' , $e->
	getMessage();
	die();
}

if(isset($_POST['predifined_query'])){

	if(strlen($_POST['predifined_query']) == 1 || strlen($_POST['predifined_query']) == 2 ) {


		echo 'kabla2';
		$statement = $db->prepare($normal_query[$_POST['predifined_query'] - 1]);// arg 1-16/ array 0-15
		if ($statement->execute()) {
			echo 'requete reussie <br/>!';
			while ($item = $statement->fetch()) {
				echo'<pre>';
				print_r($item);
				echo'</pre>';
			}
		}

    }
	else{echo 'pas kabla';}
	
}




