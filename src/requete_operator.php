<?php



function operator_interface()
{


    require_once 'requetes_file.php';
    require_once "display.php";

    if (isset($_POST['predifined_query'])) {

        if (strlen($_POST['predifined_query']) == 1 || strlen($_POST['predifined_query']) == 2) {

            try {
                $db = new  PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            } catch (PDOException $e) { //on catch, on type ce qu'on à attrapé et on le stocke dans e
                echo '<strong>PDO Exception</strong><br />', $e->
                getMessage();
                die();
            }

            $statement = $db->prepare($normal_query[$_POST['predifined_query']]);// arg 1-16/ array 0-15
            if ($statement->execute()) {
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
                    foreach ($item as $value) {

                        $display_content .= '<td>';

                        $display_content .= $value;
                        $display_content .= '</td>';
                    }
                    $display_content .= '</tr>';
                }
                $display_content .= '</table>';
                display_interface($display_content, '', '', '', 'admin', 'alain');
            }

        } else {
            echo 'pas kabla';
        }

    } else {

        display_interface();
    }

}


