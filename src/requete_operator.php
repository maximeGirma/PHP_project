<?php 


require_once '../config.inc.php';
require_once 'requetes_file.php';
require_once "display.php";


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



        $statement = $db->prepare($normal_query[$_POST['predifined_query'] - 1]);// arg 1-16/ array 0-15
        if ($statement->execute()) {
            $cols_id_activator = true;
            $display_content="";

            $display_content .= '<table>';
            $display_content .= '<tr>';

            while ($item = $statement->fetch(PDO::FETCH_ASSOC)) {
                if($cols_id_activator) {
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
            display_interface($display_content);
        }

    }
    else{echo 'pas kabla';}

}else{
    require_once "display.php";
    display_interface();
}




