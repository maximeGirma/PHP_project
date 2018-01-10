<?php

//echo $_POST['ID'].'<br/>';
//echo $_POST['PSW'].'<br/>';

//$test = 'admin';
//$password = password_hash($test,PASSWORD_DEFAULT);
//$user_password = password_hash($_POST['PSW'],PASSWORD_DEFAULT);
//echo $password.'<br/>';
//echo $user_password.'<br/>';
if($_POST['ID'] == 'operator' and $_POST['PSW']== 'admin'){
	header('Location: pages_html/consultation_donnees.html');
  	exit();
}else{echo "echec de l'authentification";}
?>
