<?php

function custom_nav(){

	if ($id_type_utilisateur == 1) && $_SESSION['tracker'] == 1 {

		return "<li id='sous_menu_1_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Operateur'/>
			</form>
		</li>
		<li id='sous_menu_2_off'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestionnaire'/>
			</form>
		</li>
		<li id='sous_menu_3_off'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administrateur'/>
			</form>
		</li>";
	}				

	else if ($id_type_utilisateur == 2) && $_SESSION [tracker] == 1 {

		return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Operateur'/>
			</form>
		</li>
		<li id='sous_menu_2_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestionnaire'/>
			</form>
		</li>
		<li id='sous_menu_3_off'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administrateur'/>
			</form>
		</li>";
	}				
		
	else if ($id_type_utilisateur == 2 && $_SESSION['tracker'] == 2 {

		return "<li id='sous_menu_1_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Operateur'/>
			</form>
		</li>
		<li id='sous_menu_2_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestionnaire'/>
			</form>
		</li>
		<li id='sous_menu_3_off'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administrateur'/>
			</form>
		</li>";
	}				

	else if ($id_type_utilisateur == 3) && $_SESSION['tracker'] == 1 {

		return "<li id='sous_menu_1_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Operateur'/>
			</form>
		</li>
		<li id='sous_menu_2_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestionnaire'/>
			</form>
		</li>
		<li id='sous_menu_3_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administrateur'/>
			</form>
		</li>";
	}				
		
	else if ($id_type_utilisateur == 3) && $_SESSION['tracker'] == 2 {

		return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Operateur'/>
			</form>
		</li>
		<li id='sous_menu_2_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestionnaire'/>
			</form>
		</li>
		<li id='sous_menu_3_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administrateur'/>
			</form>
		</li>";
	}				
		
	else if ($id_type_utilisateur == 3) && $_SESSION['tracker'] == 3 {

		return "<li id='sous_menu_1_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='1'/>
				<input type='submit' value='Operateur'/>
			</form>
		</li>
		<li id='sous_menu_2_on'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='2'/>
				<input type='submit' value='Gestionnaire'/>
			</form>
		</li>
		<li id='sous_menu_3_current'>
			<form id='oui' action='index.php' method='POST'>
				<input type='hidden' name='interface_choice' value='3'/>
				<input type='submit' value='Administrateur'/>
			</form>
		</li>";
	}				
}


			