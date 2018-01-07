<?php
echo 'pouet';
echo $_POST['ID'].'<br/>';
echo $_POST['PSW'].'<br/>';

$password = password_hash('admin',PASSWORD_DEFAULT);
echo $password;
?>
