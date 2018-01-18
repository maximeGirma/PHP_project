<?php
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

year(now()) AS 'POUR_L_ANNEE',
count(distinct carte_abonnement.id_personne) AS 'MINEURS_AVEC_ABO_VALIDE'

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
",
"
SELECT /*REQUETE 4*/
nom_commune AS 'VILLE'
,code_post AS 'CODE POSTAL'
,personnes.id_personne AS 'USAGER'
,personnes.prenom AS 'PRENOM'
,personnes.nom AS 'NOM'
,date_format(personnes.naissance ,'%d/%m/%Y')
,concat( num_rue
,' ',
rue
,' ',
ifnull(residence, ''),
ifnull(batiment, '')) AS 'ADRESSE'
FROM carte_abonnement
INNER JOIN personnes ON carte_abonnement.id_personne = personnes.id_personne
INNER JOIN habite ON personnes.id_personne = habite.id_personne
INNER JOIN adresse ON habite.id_adresse = adresse.id_adresse
INNER JOIN ville_cp ON adresse.id_ville = ville_cp.id_ville
LEFT JOIN resilie ON carte_abonnement.id_abonnement = resilie.id_abonnement
WHERE carte_abonnement.date_fin_validite > now() AND resilie.date_resiliation is null
/* GROUPE PAR PERSONNE ET PAR VILLE */

ORDER BY nom_commune;
",
"
SELECT/*REQUETE 5*/
carte_abonnement.id_type_ab AS 'NO'
,type_abonnement.denom_ab AS 'TYPE_ABONNEMENT'
,count( if(carte_abonnement.date_fin_validite > now(),
if(resilie.date_resiliation is null,type_abonnement.denom_ab,null),null)) AS 'NOMBRE_D_ABONNEMENTS EN COURS DE VALIDITE'
,year(now()) AS 'ANNEE'
FROM type_abonnement
INNER JOIN carte_abonnement ON carte_abonnement.id_type_ab = type_abonnement.id_type_ab
LEFT JOIN resilie ON carte_abonnement.id_abonnement = resilie.id_abonnement
group by carte_abonnement.id_type_ab
ORDER BY carte_abonnement.id_type_ab;",
"
SELECT/*REQUETE 6*/
carte_abonnement.id_type_ab AS 'NO ABONNEMENT'
,type_abonnement.denom_ab AS 'TYPE ABONNEMENT'
,concat((
(sum(if( year(carte_abonnement.date_paiement) = 2017, if(prix_duplicata != 0, 0,
histo_tarif_abo.tarif),0)))
+
(sum(if(year(duplicata.date_duplicata) = 2017, duplicata.prix_duplicata, 0)))
-
(sum(if(year(resilie.date_resiliation) = 2017, if(prix_duplicata != 0, 0, resilie.montant_remb)
,0
)))),'€') AS 'CHIFFRE_D_AFFAIRE_TOTAL_SUR_L_ANNEE'
, 2017 AS 'ANNEE'
from carte_abonnement
inner join type_abonnement on carte_abonnement.id_type_ab = type_abonnement.id_type_ab
inner join histo_tarif_abo on carte_abonnement.id_type_ab = histo_tarif_abo.id_type_ab
left join duplicata on carte_abonnement.id_abonnement = duplicata.id_abonnement
left join resilie on carte_abonnement.id_abonnement = resilie.id_abonnement
where (year(histo_tarif_abo.date_prise_effet) = 2017 )
group by type_abonnement.id_type_ab
order by carte_abonnement.id_type_ab;",
"
SET @id_mineur = $optional_parameter
SELECT /*!!!!!! SET OPTIONNAL_PARAMETER BEFORE REQUEST AND CHECK EMPTY RETURN REQUEST 6*/
personnes.id_personne
AS 'USAGER N°'
,concat(personnes.prenom, ' ',personnes.nom)
AS 'USAGER'
,concat(year(now()) - year(personnes.naissance), ' ans')
AS 'AGE'
,concat(representant.prenom, ' ',representant.nom)
AS 'REPRESENTANT'
,concat( r_adresse.num_rue
,' ',
r_adresse.rue
,' ',
ifnull(r_adresse.residence, ''),
ifnull(r_adresse.batiment, ''))
AS 'ADRESSE REPRESENTANT'
,r_ville_cp.nom_commune
AS 'VILLE REPRESENTANT'
,r_ville_cp.code_post
AS 'CODE POSTAL REPRESENTANT'
,representant.email
AS 'E-MAIL REPRESENTANT'
,r_telephone.num_telephone
AS 'N° de TELEPHONE TUTEUR'
,r_type_telephone.denom_typ_tel
AS 'TYPE de TELEPHONE REPRESENTANT'/* table 'personne' pour les informations du mineur */
FROM personnes
INNER JOIN joindre ON personnes.id_personne = joindre.id_personne
INNER JOIN telephone ON joindre.id_tel = telephone.id_tel
INNER JOIN type_telephone ON telephone.id_type_tel = type_telephone.id_type_tel
INNER JOIN habite ON personnes.id_personne = habite.id_personne
INNER JOIN adresse ON habite.id_adresse = adresse.id_adresse
INNER JOIN ville_cp ON adresse.id_ville = ville_cp.id_ville
/* table 'personne' renommée 'représentant' pour associer les informations du tuteur au mineur */
left join personnes as representant on personnes.id_personne_1 = representant.id_personne
inner join joindre as r_joindre on representant.id_personne = r_joindre.id_personne
inner join telephone as r_telephone on r_joindre.id_tel = r_telephone.id_tel
inner join type_telephone as r_type_telephone on r_telephone.id_type_tel =
r_type_telephone.id_type_tel
inner join habite as r_habite on representant.id_personne = r_habite.id_personne
inner join adresse as r_adresse on r_habite.id_adresse = r_adresse.id_adresse
inner join ville_cp as r_ville_cp on r_adresse.id_ville = r_ville_cp.id_ville
where personnes.id_personne = @id_mineur
group by r_telephone.num_telephone, r_adresse.num_rue, r_adresse.rue, r_adresse.residence, r_adresse.batiment, r_ville_cp.nom_commune, r_ville_cp.code_post
;
",
"
SELECT/*REQUETE 8*/
year(descend_point.date_debut_descent) AS 'ANNEE'
,list_etablissement.id_etablissement AS 'NO_ETAB'
,list_etablissement.denomination_etablissement AS 'ETABLISSEMENT'
,count(descend_point.date_debut_descent) AS 'NOMBRE_USAGERS'
FROM descend_point
inner join passe
inner join arrets on descend_point.id_arret = arrets.id_arret
left join list_etablissement on list_etablissement.id_etablissement = passe.id_etablissement
inner join carte_abonnement on descend_point.id_abonnement = carte_abonnement.id_abonnement
GROUP BY ANNEE, list_etablissement.denomination_etablissement, passe.id_etablissement
order by ANNEE desc, passe.id_etablissement;"
);