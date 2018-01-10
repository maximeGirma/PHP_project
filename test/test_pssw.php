<?php


echo 'mot de passe: '.$_POST['PSW'].'<br/>';

$test = 'jambonneau';
echo 'mot de passe demandé: '.$test.'<br/>';

echo'<br/><br/><br/><br/>';


echo crypt($_POST['ID'],'USERNAME');
echo crypt($_POST['ID'],'USERNAME');
$password = crypt($test,'PASSWORD');
$user_password = crypt($_POST['PSW'],'PASSWORD');

echo $password.'<br/>';
echo $user_password.'<br/>';

if($_POST['ID'] == 'operator' and $_POST['PSW']== 'admin'){
    header('Location: pages_html/consultation_donnees.html');
    exit();
}else{echo "echec de l'authentification";}


