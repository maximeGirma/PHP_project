<?php 
//effectue des requetes SQL en fonction de l'argument recu
//1 - afficher les propriétés des usagers
$normal_query = array(
"SELECT
personnes.prenom
AS 'PRENOM'
,personnes.nom
AS 'NOM'
,date_format(personnes.naissance ,'%d/%m/%Y') AS 'DATE DE NAISSANCE'
/* fonction 'date_format()' utilisée pour changer la forme de la date en jj/mm/aaa */
,concat( adresse.num_rue
,' ',
/* fonction 'concat()' utilisée pour rassembler differentes données dans une seule colonne */
adresse.rue
,' ',
ifnull(adresse.residence, ''),
/* fonction 'ifnull()' utilisée pour remplacer les valeurs 'null' par la valeur souhaitée */
ifnull(adresse.batiment, '')
)
AS 'ADRESSE'
,ville_cp.nom_commune
AS 'VILLE'
,ville_cp.code_post
AS 'CODE POSTAL'
,telephone.num_telephone
AS 'NUMERO DE TELEPHONE'
,type_telephone.denom_typ_tel
AS 'TYPE DE TELEPHONE'
/*venant de la table personnes: */
FROM
personnes
/*jointe avec les tables suivantes*/
INNER JOIN joindre ON personnes.id_personne = joindre.id_personne
INNER JOIN telephone ON joindre.id_tel = telephone.id_tel
INNER JOIN type_telephone ON telephone.id_type_tel = type_telephone.id_type_tel
INNER JOIN habite ON personnes.id_personne = habite.id_personne
INNER JOIN adresse ON habite.id_adresse = adresse.id_adresse
INNER JOIN ville_cp ON adresse.id_ville = ville_cp.id_ville
ORDER BY personnes.nom ASC;",
"SELECT 

		year(now()),count(distinct carte_abonnement.id_personne)
			
	FROM 
		carte_abonnement
		
		INNER JOIN personnes ON carte_abonnement.id_personne = personnes.id_personne
		LEFT JOIN resilie ON carte_abonnement.id_abonnement = resilie.id_abonnement
	
	WHERE
		personnes.naissance > (now() - interval 18 year)
	AND
		carte_abonnement.date_fin_validite > now()
	AND 
		date_resiliation is null
		
	ORDER BY personnes.nom;"

,
"SELECT
personnes.id_personne AS 'USAGER No',
personnes.prenom AS 'PRENOM',
personnes.nom AS 'NOM',
date_format(personnes.naissance,'%d%m%Y') AS 'DATE DE NAISSANCE',
concat(adresse.num_rue
,' ',
adresse.rue
,' ',
ifnull(residence, ''),
ifnull(batiment, '')) AS 'ADRESSE',
nom_commune AS 'VILLE',
code_post as 'CODE POSTAL'
FROM carte_abonnement
INNER JOIN personnes ON carte_abonnement.id_personne = personnes.id_personne
INNER JOIN habite ON personnes.id_personne = habite.id_personne
INNER JOIN adresse ON habite.id_adresse = adresse.id_adresse
INNER JOIN ville_cp ON adresse.id_ville = ville_cp.id_ville
LEFT JOIN resilie ON carte_abonnement.id_abonnement = resilie.id_abonnement
WHERE carte_abonnement.date_fin_validite > now() AND resilie.date_resiliation is null
ORDER BY personnes.id_personne;
;"
);

require_once '../config.inc.php';


try{
	$db = new  PDO('mysql:host='.DB_HOST. ';dbname='. DB_NAME, DB_USER, DB_PASS);
}

catch (PDOException $e){ //on catch, on type ce qu'on à attrapé et on le stocke dans e
	echo '<strong>PDO Exception</strong><br />' , $e->
	getMessage();
	die();
}
if(isset($_POST['predifined_query'])){
	$request = $_POST['predifined_query'];
	echo 'kabla1';
	if ($request == 1){
		echo 'kabla2';
		$statement = $db->prepare($normal_query[0]);
		if ($statement->execute()) {
			echo'requete reussie <br/>!';
			//$item = $statement->fetchObject();
			while($item = $statement->fetchObject()){
				echo $item->NOM;
			}
		}
	}
	else if($request==3){
		$statement = $db->prepare($normal_query[2]);
		if ($statement->execute()) {
			echo'requete reussie <br/>!';
			//$item = $statement->fetchObject();
			while($item = $statement->fetchObject()){
				echo $item->NOM;
			}
		}
	}
	else{echo 'pas kabla';}
	
}

?>


