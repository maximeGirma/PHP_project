<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 13/01/18
 * Time: 09:54
 */
/*-- ---------------------------
 * Created by IntelliJ IDEA.
 * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 12/01/18
 * Time: 14:51
 *  Version 1.0
 * Display_interface() est appelé par soit par index.php soit par les différentes fonctions d'interface.
 * Elle affiche le template du site et appelle custom_nav() pour generer un menu dynamique.
 * Elle peut prendre jusqu'a 4 arguments sous forme de chaînes de caractères pour afficher du contenu
 * entre le header et le footer.
 *
 *
 * display_query_result() est appelé par crud_interface() et sert à afficher certains retour
 * de requetes SQL.
 *
---------------------------- */

require_once "custom_nav.php";


function display_interface($content_1 = '',$content_2='',$content_3='',$content_4='' ){

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
						
						" . custom_nav() ."
							
						
						<nav id=\"deconnect\">
							<form id='oui' action='index.php' method='POST'>
                                <input type='hidden' name='deconnexion' value='1'/>
                                <input id =\"deconnexion_button\" type='submit' value='Quitter'/>
			                </form>
						</nav>
					</ul>

										
					<picture id=\"e_egg_o\">
						<img onClic=\"hidden\" src=\"http://i0.kym-cdn.com/entries/icons/original/000/000/099/what-is-love-570898416.gif\" alt=\"-image-\">
						<img id=\"e_bus_o\" src=\"images/bus_t.png\" alt=\"-image-\">
					</picture>
						
					
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

				
				
";

    $footer="	    </section>

	    		</main>

    		</section>															<!-- fin phrasing -->

		        
				<section id=\"end\">									<!-- début footer -->
	
			<footer>
			
				<p>
				<a href=\"#\"_blank\">MENTIONS LÉGALES</a>
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


function display_query_result($statement, $optionnal_string = "", $optionnal_string_2 = "")
{
    switch ($_POST['afficher']){
        case 1: $type_user = 'Operateurs';
            break;
        case 2: $type_user = 'Gestionnaires';
            break;
        case 3: $type_user = 'Administrateurs';
            break;
        default:$type_user = '';
            break;
    }
    $string_to_return ="";
    $cols_id_activator = TRUE;
    $string_to_return.= '<form action="index.php" method="post">';
    $string_to_return.= '<table id="tableau_operateur">';
    $string_to_return.= '<caption>'.$type_user.'</caption>';

    while ($item = $statement->fetch(PDO::FETCH_ASSOC)) {

        $string_to_return.= '<form action="index.php" method="post"><tr>';
        if ($cols_id_activator) {
            foreach ($item as $key => $element) {
                $string_to_return.= '<th>' . $key . '</th>';
            }
            $cols_id_activator = false;
        }
        $string_to_return.= '</tr> <tr>';
        foreach ($item as $key => $value) {

            if ($key == 'id_utilisateur') {
                $string_to_return.= '<input name="modifier" type="hidden" value = "' . $value . '">';
            }
            $string_to_return.= '<td>';

            $string_to_return.= $value;
            $string_to_return.= '</td>';

        }
        $string_to_return.= '<td>';


        $string_to_return.= $optionnal_string;
        $string_to_return.= '</td>';
        $string_to_return.= '</tr></form>';

    }
    $string_to_return.= '</table></form><br/>';
    $string_to_return.= $optionnal_string_2;
    return $string_to_return;
}

