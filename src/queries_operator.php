<?php

/*
 * Created by IntelliJ IDEA.
 * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 18/01/18
 * Time: 18:51
 * Version 0.9
 * La fonction operateur_interface est appelée par index.php et sert à afficher le contenu de la
 * base de données. La fonction appelle dislay_interface() pour afficher l'interface. Puis, si elle
 * a recu  l'argument adéquat elle affiche le resultat d'une requete pré-enregistré dans queries_files.php
 * toujours grace à display_interface()
 */


function operator_interface()
{
    $_SESSION['tracker']=1;


    include 'queries_file.php';
    require_once "display.php";
    require_once 'bdd_access.php';


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
                                <option value='8' >Requête 9</option>
                                <option value='9' >Requête 10</option>
                                <option value='10' >Requête 11</option>
                                <option value='11' >Requête 12</option>
                                <option value='12' >Requête 13</option>
                                <option value='13' >Requête 14</option>
                                <option value='14' >Requête 15</option>
                                <option value='15' >Requête 16</option>
    

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
					</form><form action='index.php' method='POST'>
                                <nav id=\"clear\" >
                                    <input id=\"effacer_button\" value=\"EFFACER\" name=\"REQUEST!\" type=\"submit\">
                                </nav>		
                            </form>
							
						</div>	
						
											
				</fieldset>";






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
            }else display_interface($op_interface_html,"Requete non valide");

        } else {
            display_interface($op_interface_html,'Une erreur innatendue s\'est produite');
        }

    } else {

        display_interface($op_interface_html);
    }

}


