<?php 


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

echo include ("pages_html/consultation_donnees.html");

if(isset($_POST['predifined_query'])){

	if(strlen($_POST['predifined_query']) == 1 || strlen($_POST['predifined_query']) == 2 ) {


        echo 'kabla2';
        $statement = $db->prepare($normal_query[$_POST['predifined_query'] - 1]);// arg 1-16/ array 0-15
        if ($statement->execute()) {
            $cols_id_activator = true;


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

    }
    else{echo 'pas kabla';}

}




