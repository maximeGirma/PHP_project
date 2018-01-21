<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 20/01/18
 * Time: 16:10
 */

function gestionnaire()
{
    $_SESSION['tracker']=2;
    require_once 'display.php';
    include 'requetes_file.php';
    require_once 'requete_operator.php';



    $gestion_interface = '<form action="index.php" method="POST">
            <label>nom de la personne recherchée</label>
            <input name="gestion_recherche" required/>
            <input type="submit" value="rechercher"></form>';
    $display_content ="";


    if(isset($_POST['gestion_recherche'])) {
        $end_query= 'personnes.nom LIKE \'%'.$_POST['gestion_recherche'].'%\'';
        $statement = bdd_acces($gestion_query . $end_query);

        $cols_id_activator = true;
        $display_content = "";

        $display_content .= '<table id="tableau_operateur">';
        $display_content .= '<tr>';

        while ($item = $statement->fetch(PDO::FETCH_ASSOC)) {
            if ($cols_id_activator) {
                foreach ($item as $key => $element) {
                    $display_content .= '<th>' . $key . '</th>';
                }
                $cols_id_activator = false;
            }
            $display_content .= '</tr> <tr>';
            $display_content .= '<form action="index.php" method="POST">';
            foreach ($item as $key => $value) {

                $display_content .= '<td>';
                if ($key == 'id_utilisateur') {
                    $display_content .= '<input name="id_usager" type="hidden" value = "' . $value . '">';
                }
                $display_content .= $value;
                $display_content .= '</td>';
            }

            $display_content .= '<td><input type="submit" name="update_gestion" value="Modifier"></td></form>';
            $display_content .= '</tr>';
        }
        $display_content .= '</table>';


    }elseif(isset($_POST['id_usager'])){




        $modifier = ' personnes.id_personne = '.$_POST['id_usager'];

        if ($statement = bdd_acces($gestion_query . $modifier . ';')) {


            $statement->execute();
            $item = $statement->fetchObject();

            $display_content= '<form action="index.php" method="post">
                <label for="nom">nouveau nom : </label>
                <input name="nom" type="text" required value="' . $item->NOM . '">
                <label for="prenom">nouveau prenom : </label>
                <input name="prenom" type="text" required value="' . $item->PRENOM . '">
                <br/>
                <label for="email">nouvel email: </label>
                <input name="e_mail" type="text" required value="'.$item->EMAIL.'">
                <label for="date de naissance">nouvelle date de naissance: </label>
                <input name="naissance" type="text" required value="'.$item->DATE_DE_NAISSANCE.'">
                
                <input name="update" type="hidden" value = "1">
                <input name="id_utilisateur" type="hidden" value = "' . $item->id_utilisateur . '">
                <input type="submit" value="Modifier">
                </form>'
                ;


        }




    }

    display_interface($gestion_interface, $display_content);
}

