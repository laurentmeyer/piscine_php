<?php

include("auth.php");
session_start();
date_default_timezone_set("Europe/Paris");

$msg_folder = "../private/";
$msg_file = "chat";
$file = $msg_folder . $msg_file;

if (!file_exists($file))
{
	if (!file_exists($msg_folder))
		mkdir($msg_folder);
	$fd = fopen($file, 'x');
	flock($fd, LOCK_EX);
	$messages[] = $new;
	file_put_contents($file, serialize(array()));
	flock($fd, LOCK_UN);
	fclose($fd);
}

if (($login = $_POST['login']) == NULL
	|| ($passwd = $_POST['passwd']) == NULL
	|| !auth($login, $passwd))
{
	$_SESSION['loggued_on_user'] = "";
	header("Location: index.html");
}
else
{
	$_SESSION['loggued_on_user'] = $login;
	echo '<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>' . "\n";
	echo '<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>' . "\n";
}

?>
