<?php



function operator_interface()
{
    $_SESSION['tracker']=1;

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
							
							<nav id=\"clear\" >
								<input id=\"effacer_button\" value=\"EFFACER\" name=\"REQUEST!\" type=\"submit\">
							</nav>	
							
						</div>	
						
					</form>
					
				</fieldset>";






    include 'requetes_file.php';
    require_once "display.php";
    require_once 'bdd_access.php';

    if(isset($_POST['additional_parameter'])){

        $optional_parameter = $_POST['additional_parameter'];
        $normal_query[$_POST['predifined_query']] .= $optional_parameter. "
                                    group by r_telephone.num_telephone, r_adresse.num_rue, 
                                    r_adresse.rue, r_adresse.residence, r_adresse.batiment, 
                                    r_ville_cp.nom_commune, r_ville_cp.code_post
                                    ;
                                    ";

    }

    if (isset($_POST['predifined_query'])) {

        if (strlen($_POST['predifined_query']) == 1 || strlen($_POST['predifined_query']) == 2) {


            if ($statement = bdd_acces($normal_query[$_POST['predifined_query']])) {
                //echo $statement->execute();
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


