/* Created by IntelliJ IDEA.
 * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 19/01/18
 * Time: 11:25
 * Version 0.9
 * description_query() est appelé onClick sur la page HTML renvoyé par operator_interface()
 * Elle affiche la description de requete stockée dans get_description() correspondant à l'argument
 * renseigné.
 */
function get_description(description_number)
{
    var description=[
        "Afficher les propriétés des usagers (Nom, Prénom, Adresse complète, Téléphone, Date de naissance)",
        "Afficher le nombre d’usagers mineurs ayant un abonnement en cours de validité.",
        "Afficher la liste des usagers ayant des abonnements en cours de validité",
        "Afficher la liste des usagers ayant des abonnements en cours de validité et classée par commune",
        "Afficher le nombre d’abonnements en cours de validité pour chacun des types d’abonnements",
        "Afficher le chiffre d’affaires réalisé sur l’année en cours pour chacun des types d’abonnements",
        "Afficher les informations du représentant légal d’un usager donné" +
        "<input type=\"text\" name=\"additional_parameter\" required placeholder='ID du mineur'>",
        "Afficher le nombre d’usagers par année et par établissement scolaire"
    ];
    return description[description_number];
}



function description_query(description_number)
{


    var content = document.getElementById('desc_requetes').querySelector("span");
    content.innerHTML = get_description(description_number);
}