<?php
if ($_POST['login'] === "" || $_POST['passwd'] === "" || $_POST['submit'] !== "OK")
{
	header("refresh:3; url=index.php");
	echo "Erreur envoie information";
	exit;
}
if (!file_exists("../private"))
	mkdir ("../private");
if (file_exists("../private/passwd"))
{
	$file = unserialize(file_get_contents("../private/passwd"));
	foreach ($file as $key)
		if ($key['login'] === $_POST['login'])
		{
			header("refresh:3; url=create.html");
			echo "Compte deja existant, veuillez utiliser un autre identifiant :)";
			exit;
		}
}
$mytab = ["login" => $_POST['login'], "passwd" => hash(whirlpool, $_POST['passwd'])];
$file[] = $mytab;
$content = serialize($file);
header("refresh:3; url=index.php");
file_put_contents("../private/passwd", $content);
echo "Merci de vous etre inscrit<br>";
echo "Vous pouvez vous connecter :)";
?>
