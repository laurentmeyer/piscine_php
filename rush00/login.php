<?php

session_start();
include("auth.php");
if (auth($_POST['login'], $_POST['passwd']))
{
	$_POST['login'] != 'admin' ? header("refresh:3; url=index.php") : header("refresh:3; url=admin.php");
	$_SESSION['loggued_on_user'] = $_POST['login'];
	echo "Bienvenue ".$_SESSION['loggued_on_user'];
}
else
{
	header("refresh:30; url=index.php");
	$_SESSION['loggued_on_user'] = "";
	echo "Mauvais mot de passe ou identifiant, veuillez ressayer :)";
}
?>
