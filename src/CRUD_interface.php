<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 12/01/18
 * Time: 14:51
 */

echo include("pages_html/CRUD_display.html");

if(isset($_POST['afficher'])) {

    $display_query = "    
SELECT 
`id_utilisateur`,`nom_utilisateur`,`prenom_utilisateur` 
FROM
utilisateur
WHERE id_type_utilisateur =";
$cols_id_activator = true;
    if (strlen($_POST['afficher']) == 1) {
        try {
            $db = new  PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $e) { //on catch, on type ce qu'on à attrapé et on le stocke dans e
            echo '<strong>PDO Exception</strong><br />', $e->
            getMessage();
            die();
        }
        $i = 1;
        while ($i < 3) {
            $statement = $db->prepare($display_query . $i . ';');// arg 1-16/ array 0-15
            if ($statement->execute()) {
                echo '<table>';
                echo '<tr>';

                while ($item = $statement->fetch(PDO::FETCH_ASSOC)) {
                    if($cols_id_activator) {
                        foreach ($item as $key => $element) {
                            echo '<th>' . $key . '</th>';
                        }
                        $cols_id_activator = false;
                    }
                    echo '</tr> <tr>';
                    foreach ($item as $value) {

                        echo '<td>';

                        echo $value;
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }
            $i++;
        }
    }
}