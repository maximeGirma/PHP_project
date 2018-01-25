<?php
/**
 * Created by IntelliJ IDEA.
 * User: Maxime
 * Date: 20/01/18
 * Time: 16:10
 * Version 0.6
 * La fonction gestionnaire est appellée par index.php et permet au gestionnaire de modifier la BDD
 * Elle affiche une interface qui permet de rechercher un nom dans la base puis selon les arguments reçus
 * elle affiche différentes interfaces qui permettent de modifier les données de la base.
 * Elle utilise des requetes préconstruites et stockées dans queries_files.php
 *L'affichage des resultats se fait grace à la fonction display_interface()
 */

function gestionnaire()
{
    $_SESSION['tracker']=2;

    require_once 'display.php';
    include 'queries_file.php';
    require_once 'requete_operator.php';
    require_once 'bdd_access.php';


    $gestion_interface = '
		<fieldset>
		<legend>Rechercher</legend>
            <form action="index.php" method="POST">
                <label>Rechercher une personne par son nom</label><br><br>
                <input id="field_name" name="gestion_recherche" placeholder="Nom" />
                <input id="query_name" type="submit" value="AFFICHER">
            </form>
		</fieldset>
            ';
    $display_content ="";


    if(isset($_POST['gestion_recherche'])) {
        $end_query= 'personnes.nom LIKE \'%'.$_POST['gestion_recherche'].'%\'';
        $end_query.= ' GROUP BY personnes.id_personne, adresse.num_rue,adresse.rue,adresse.residence,adresse.batiment,
                    ville_cp.nom_commune,ville_cp.code_post';
        $statement = bdd_acces($gestion_query . $end_query);


        $cols_id_activator = true;
        $display_content = "";

        $display_content .= '<table id="tableau_operateur">';
        $display_content .= '<tr>';

        while ($item = $statement->fetch(PDO::FETCH_ASSOC)) {


            if ($cols_id_activator) {
                foreach ($item as $key => $element) {
                    if ($key != 'id_utilisateur') $display_content .= '<th>' . $key . '</th>';
                }
                $cols_id_activator = false;
            }
            $display_content .= '</tr> <tr>';
            $display_content .= '<form action="index.php" method="POST">';
            foreach ($item as $key => $value) {


                if ($key == 'id_utilisateur') {
                    $display_content .= '<input name="id_usager" type="hidden" value = "' . $value . '">';

                } else {
                    $display_content .= '<td>';
                    $display_content .= $value;
                    $display_content .= '</td>';
                }
            }

            $display_content .= '<td><input type="submit" name="update_gestion" value="Modifier"></td>';
            $display_content .= '</tr></form>';
            $error_search = 1;
        }
        $display_content .= '</table>';
        if(!isset($error_search))$display_content = 'Votre recherche n\'a retourné aucun resultat';

    }elseif(isset($_POST['id_usager'])){


        $modifier = ' personnes.id_personne = '.$_POST['id_usager'].' '.
                    'GROUP BY personnes.id_personne, adresse.num_rue,adresse.rue,adresse.residence,adresse.batiment,
                    ville_cp.nom_commune,ville_cp.code_post';

        if ($statement = bdd_acces($gestion_query . $modifier . ';')) {
            

            $statement->execute();
            $item = $statement->fetchObject();

            $city_list_returned = bdd_acces($city_query);
            $city_list_temp = $city_list_returned->fetchAll();
            $city_list = [];
            foreach ($city_list_temp as $city){
                $city_list[] = $city[0];
            }
            $display_city ="";
            foreach($city_list as $city)
            {
                if($city == $item->VILLE)
                {
                    $display_city .= '<option selected>' . $city . '</option>';
                }else{
                    $display_city .= '<option>' . $city . '</option>';
                }
            }

                $display_content = '<form id="formulaire_gestion" action="index.php" method="post">
                <table><tr><td><label for="nom">Nom : </label></td>
                <td><input name="nom" type="text" required value="' . $item->NOM . '"></p></td></tr>
                <tr><td><p><label for="prenom">Prenom : </label></td>
                <td><input name="prenom" type="text" required value="' . $item->PRENOM . '"></p></td></tr>
                <tr><td><p><label for="email">Email: </label></td>
                <td><input name="e_mail" type="text" required value="' . $item->EMAIL . '"></p></td></tr>
                <tr><td><p><label for="date de naissance">Date de naissance: </label></td>
                <td><input name="naissance" type="text" required value="' . $item->NAISSANCE . '"></p></td></tr>
                <tr><td><p><label>Numero de rue:</label></td>
                <td><input name="numero_de_rue" type="text" required value="'. $item->NUMERO_RUE.'"></p></td></tr>
                <tr><td><p><label>Rue:</label></td>
                <td><input name="rue" type="text" required value="'. $item->RUE.'"></p></td></tr>
                <tr><td><p><label>Ville:</label></td>
                <td><select name="ville" required ></p>
                '.$display_city.'</select></td></tr>
                <tr><td colspan="2"><input name="update" type="hidden" value = "1">
                <input name="id_utilisateur" type="hidden" value = "' . $item->id_utilisateur . '">
                <input id="query_name" type="submit" value="APPLIQUER"></td></tr>
                </table>
                </form>';


    }
    }
    if (isset($_POST['update'])) {

        $temporary = bdd_acces($get_city_code);
        $_SESSION['id_ville'] = $temporary->fetch()[0];


        if (bdd_acces($gestionnaire_update_query))
        {
            display_interface($gestion_interface, 'Modification effectuée avec succès');

        }else display_interface($gestion_interface,'meh...jamais du premier coup');

    }
    display_interface($gestion_interface, $display_content);
}

