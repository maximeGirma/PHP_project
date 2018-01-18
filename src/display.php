<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 13/01/18
 * Time: 09:54
 */
/*-- ---------------------------
STAPA ACCES - page opérateur (utilisateurs)
PHP diplay
V 0.1.08
---------------------------- */


function display_interface($content_1 = '',$content_2='',$content_3='',$content_4='',
                           $type_utilisateur="", $nom_utilisateur=""){

    $type_and_name_user ="";// '<p id = "username">';

    switch($_SESSION['id_type_utilisateur']){
        case 1: $type_and_name_user .= "Operateur ";
            break;
        case 2: $type_and_name_user .= "Gestionnaire ";
            break;
        case 3: $type_and_name_user .= "Administrateur ";
            break;
        default:
            ;
    }
    $type_and_name_user .= "<br>" . $_SESSION['prenom_utilisateur'] ." ".$_SESSION['nom_utilisateur'];
    //$type_and_name_user .= '</p>';


    $header="
    <!-- ---------------------------
	STAPA ACCES - page opérateur (utilisateurs)

	V 0.1.06
	---------------------------- -->

	<!DOCTYPE html>
	<html lang=\"fr\">

    
    
    <head>

	<title>Stapa Access</title>
	<meta charset=\"utf-8\">
	<meta name=\"description\" content=\"page\">
	<meta name=\"robots\" content=\"noindex,nofollow\">


	<meta name=\"author\" content=\"Team_Seven\">
	<meta name=\"copyright\" content=\"Team_Seven\">

	<link href=\"images/favicon.png\" rel=\"shortcut icon\" type=\"image/png\">
	<link href=\"css/index_style.css\" rel=\"stylesheet\" type=\"text/css\">
	<script src=\"js/description_operator_query.js\"></script>
	<!-- 	<link href=\"js/script.js\" type=\"text/javascript\"> -->

</head>

<body>

	<section id=\"content\">

		<section>															<!-- début header -->

			<header>

				<div id=\"bann_o_bg\"></div>
				<hgroup id=\"bann_o\">
				
					<h2 id=\"welcome\">
						<a > Bienvenue ".$type_and_name_user."</a>
					</h2>
					
					<ul id= 'menu_utilisateur'>                         
	
						<li id='sous_menu_1_on'><a href='requete_operator.php'>Operateur</a></li>
						<li id='sous_menu_2_on'><a href='operateur.html'>Gestionnaire</a></li>
						<li id='sous_menu_3_off'><a href='CRUD_interface.php'>Administrateur</a></li>
						<nav id=\"deconnect\">
							<a href=\"end_session.php\" target=\"_self\">Quitter</a>
						</nav>
					</ul>

					<picture id=\"logo_o\">
						<img src=\"images/bus_t.png\" alt=\"-image-\">
					</picture>
					
				</hgroup>

				

			</header>

		</section>

		<section>															<!-- début main -->

			<main>
			<div id=\"main_bg\">

				<section id=\"main_o\">

				<fieldset>
				
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
					
				</fieldset>
				</section>

			</main>

		</section>															<!-- fin phrasing -->

";

    $footer="		<section id=\"end\">									<!-- début footer -->
	
			<footer>
			
				<p>
				<a>MENTIONS LÉGALES</a>
				<a href=\"pages_html/contact.html\" target=\"_self\">CONTACT</a>
				<a>&copy TEAM SEVEN</a>
				</p>
				
			</footer>		

		</section>															<!-- fin footer -->

	</section>																<!-- fin corps -->

</body>


</html>";




    echo $header;
    echo $content_1;
    echo $content_2;
    echo $content_3;
    echo $content_4;
    echo $footer;
}
