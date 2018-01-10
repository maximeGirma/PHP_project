<?php

//echo $_POST['ID'].'<br/>';
echo 'mot de passe: '.$_POST['PSW'].'<br/>';

$test = 'admin';
echo 'mot de passe demandé: '.$test.'<br/>'
$password = password_hash($test,PASSWORD_DEFAULT);
$user_password = password_hash($_POST['PSW'],PASSWORD_DEFAULT);
echo $password.'<br/>';
echo $user_password.'<br/>';
if($_POST['ID'] == 'operator' and $_POST['PSW']== 'admin'){
    header('Location: pages_html/consultation_donnees.html');
    exit();
}else{echo "echec de l'authentification";}
