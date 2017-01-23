<?php
header("refresh:2; url=index.php");
if ($_POST['login'] === "" || $_POST['oldpw'] === "" || $_POST['newpw'] === "" || $_POST['submit'] !== "OK")
{
	echo "ERROR\n";
	exit;
}

include("auth.php");
include("db_selects.php");
include("db_updates.php");
if (auth($_POST['login'], $_POST['oldpw']))
{
	//echo "user_id = select_user_id($_POST['login'])\n";
	$user_id = select_user_id($_POST['login']);
	update_user($user_id, $_POST['login'], $_POST['newpw'], "0");
	echo "Compte modifié avec succès\n";
} else {
echo "Mot de passe erronné\n";
}

?>
