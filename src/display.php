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
V 0.1.06
---------------------------- */


function display_interface($content_1 = '',$content_2='',$content_3='',$content_4=''){

    $header="<head>

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
						<a >\$Opérateur \$Machin, bienvenue.</a>
					</h2>
					
					<nav id=\"deconnect\">
						<a href=\"index.html\" target=\"_self\">DECONNEXION</a>
					</nav>

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
				
					<legend>CHOIX DE REQUETE</legend>
					<form id=\"requetes\" action=\"requete_operator.php\" method=\"POST\">
					
						<div>
						
							<label for=\"predifined_query\">
							<select id=\"t_requetes\" name=\"predifined_query\" size=\"8\">
                                <option selected value=\"1\"> Afficher les propriétés des usagers (Nom, Prénom, Adresse complète, Téléphone, Date de naissance)</option>
                                <option value=\"2\"> Afficher le nombre d’usagers mineurs ayant un abonnement en cours de validité.</option>
                                <option value=\"3\"> Afficher la liste des usagers ayant des abonnements en cours de validité</option>
                                <option value=\"4\"> Afficher la liste des usagers ayant des abonnements en cours de validité et classée par commune</option>
                                <option value=\"5\"> Afficher le nombre d’abonnements en cours de validité pour chacun des types d’abonnements</option>
                                <option value=\"6\"> Afficher le chiffre d’affaires réalisé sur l’année en cours pour chacun des types d’abonnements</option>
                                <option value=\"7\"> Afficher les informations du représentant légal d’un usager donné</option>
                                <option value=\"8\"> Afficher le nombre d’usagers par année et par établissement scolaire</option>
								<option>9</option>
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
						
							<p id=\"desc_requetes\">
							Maecenas ultrices justo non ante lacinia, et rutrum ante mattis. Aliquam euismod sapien in gravida placerat. Mauris fringilla, neque non laoreet aliquet, ante nulla molestie sem, vitae eleifend urna nisi nec quam. Nunc sed diam neque. Morbi rhoncus est et consequat bibendum. 
							<input type=\"text\" name=\"additional_parameter\">
							</p>
			

						</div>
				
						<div id=\"random_id\">
							<nav>
								<input id=\"sub_req\" value=\"AFFICHER\" name=\"REQUEST!\" type=\"submit\">
							</nav>
						
						</div>
					
					
					</form>
				
				</fieldset>

				</section>

			</div>	
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