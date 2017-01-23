<?php
if ($_POST['login'] === "" || $_POST['passwd'] === "" || $_POST['submit'] !== "OK")
{
	header("refresh:3; url=index.php");
	echo "Erreur envoie information";
	exit;
}

include("db_inserts.php");

$ret = insert_user($_POST['login'], $_POST['passwd']);
if ($ret == "OK") {
	header("refresh:3; url=index.php");
	echo "Merci de vous etre inscrit<br>";
	echo "Vous pouvez vous connecter :)";
} else {
	header("refresh:3; url=create.html");
	if (strstr($ret, "Duplicate entry"))
		echo "Cet utilisateur existe déjà\n";
	else
		echo "Error : " . $ret;
}

?>
