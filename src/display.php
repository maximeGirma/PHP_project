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

require_once "custom_nav.php";


function display_interface($content_1 = '',$content_2='',$content_3='',$content_4=''
                           ){

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

				
				
";

    $footer="	    </section>

	    		</main>

    		</section>															<!-- fin phrasing -->

		        
				<section id=\"end\">									<!-- début footer -->
	
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


function display_query_result($statement, $optionnal_string = "", $optionnal_string_2 = "")
{
    $cols_id_activator = TRUE;
    while ($item = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo '<form action="index.php" method="post">';
        echo '<table>';
        echo '<tr>';
        if ($cols_id_activator) {
            foreach ($item as $key => $element) {
                echo '<th>' . $key . '</th>';
            }
            $cols_id_activator = false;
        }
        echo '</tr> <tr>';
        foreach ($item as $key => $value) {

            if ($key == 'id_utilisateur') {
                echo '<input name="modifier" type="hidden" value = "' . $value . '">';
            }
            echo '<td>';

            echo $value;
            echo '</td>';

        }
        echo '<td>';


        echo $optionnal_string;
        echo '</td>';
        echo '</tr>';
        echo '</table></form>';

    }
    echo $optionnal_string_2;
}
