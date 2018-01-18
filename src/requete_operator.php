<?php



function operator_interface()
{


    $op_interface_html="<fieldset>
				
					<legend>Sélection</legend>
					<form id=\"requetes\" action=\"index.php\" method=\"POST\">
					
						<div>
						
							<label for=\"predifined_query\">
							<select id=\"t_requetes\" name=\"predifined_query\" size=\"6\" >
                                <option value='0' selected onclick=\"description_query(0);\"> Propriétés des usagers</option>
                                <option value='1' onclick=\"description_query(1);\"> Usagers mineurs avec abonnement</option>
                                <option value='2' onclick=\"description_query(2);\"> Usagers avec abonnement valide</option>
                                <option value='3' onclick=\"description_query(3);\"> Usagers avec abonnement par commune</option>
                                <option value='4' onclick=\"description_query(4);\"> Abonnements valides</option>
                                <option value='5' onclick=\"description_query(5);\"> Chiffre d'affaire</option>
                                <option value='6' onclick=\"description_query(6);\"> Informations représentant légal</option>
                                <option value='7' onclick=\"description_query(7);\"> Usagers par année et établissement</option>
								<option>9 - Spam</option>
								<option>10 - Spam</option>
								<option>11 - Spam</option>
								<option>12 - Spam</option>
								<option>13 - Spam</option>
								<option>14 - Spam</option>
								<option>15 - Spam</option>
								<option>16 - Spam</option>

							<!-- ?? possible remplir par alimentation de \"table requetes\" (csv?,avec pramettres, pour ajouter des préset) ?? -->
							</label>	
							</select>
							
						</div>
						<div>
						
							<p id=\"desc_requetes\"><span>
							 
							</span>
							
							</p>
			

						</div>
						<div id=\"random_id\">
						
							<nav id=\"query\">
								<input id=\"sub_req\" value=\"AFFICHER\" name=\"REQUEST!\" type=\"submit\">
                                   			
							</nav>
							
							<nav id=\"clear\" action=\"index.php\" method=\"POST\">
								<input id=\"effacer_button\" value=\"EFFACER\" name=\"REQUEST!\" type=\"submit\">
							</nav>	
							
						</div>	
						
					</form>
					
				</fieldset>";






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
                display_interface($op_interface_html,$display_content);
            }

        } else {
            echo 'pas kabla';
        }

    } else {

        display_interface($op_interface_html);
    }

}


