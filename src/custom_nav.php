<?php
/*
 *  * Created by IntelliJ IDEA.
 * * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 12/01/18
 * Time: 14:51
 * Version 0.1
 * TODO : Refactorer le code.
 *
 * La fonction custom_nav est appelée par le display_interface().
 * Elle retourne un code HTML pour le menu de navigation qui change selon le niveau
 * de privilèges de l'utilisateur connecté ($_SESSION[id_utilisateur'])
 * et la page actuelle ($_SESSION['tracker'])
 */
function custom_nav(){

	if ($_SESSION['id_type_utilisateur'] == 1 && $_SESSION['tracker'] == 1) {

		return "<li id='sous_menu_1_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_off'>
			<form id='oui' action='#' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='button' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_off'>
			<form id='oui' action='#' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='button' value='Administration'/>
			</form>
		</li>";
	}				

	elseif ($_SESSION['id_type_utilisateur'] == 2 && $_SESSION ['tracker'] == 1) {

		return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_off'>
			<form id='oui' action='#' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='button' value='Administration'/>
			</form>
		</li>";
	}				
		
	else if ($_SESSION['id_type_utilisateur'] == 2 && $_SESSION['tracker'] == 2) {

		return "<li id='sous_menu_1_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_off'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='button' value='Administration'/>
			</form>
		</li>";
	}				

	else if ($_SESSION['id_type_utilisateur'] == 3 && $_SESSION['tracker'] == 1) {

		return "<li id='sous_menu_1_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administration'/>
			</form>
		</li>";
	}				
		
	else if ($_SESSION['id_type_utilisateur'] == 3 && $_SESSION['tracker'] == 2) {

		return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administration'/>
			</form>
		</li>";
	}				
		
	else if ($_SESSION['id_type_utilisateur'] == 3 && $_SESSION['tracker'] == 3) {

		return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administration'/>
			</form>
		</li>";
	}


    else if ($_SESSION['id_type_utilisateur'] == 1) {

        return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_off'>
			<form id='oui' action='#' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_off'>
			<form id='oui' action='#' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administration'/>
			</form>
		</li>";
    }
    else if ($_SESSION['id_type_utilisateur'] == 2) {

        return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_off'>
			<form id='oui' action='#' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administration'/>
			</form>
		</li>";
    }
    else if ($_SESSION['id_type_utilisateur'] == 3) {

        return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Consultation'/>
			</form>
		</li>
		<li id='sous_menu_2_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestion Abonnés'/>
			</form>
		</li>
		<li id='sous_menu_3_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administration'/>
			</form>
		</li>";
    }

}


			