<?php

session_start();
date_default_timezone_set("Europe/Paris");
include("auth.php");

$msg_folder = "../private/";
$msg_file = "chat";
$file = $msg_folder . $msg_file;

if ($_SESSION['loggued_on_user'] == NULL)
{
	echo "ERROR\n";
	return ;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'
	&& $_POST['msg'] !== "")
{
	$new = array();
	$new['login'] = $_SESSION['loggued_on_user'];
	$new['time'] = time();
	$new['msg'] = $_POST['msg'];

	$fd = fopen($file, 'r+');
	flock($fd, LOCK_SH);
	$messages = unserialize(file_get_contents($file));
	flock($fd, LOCK_UN);
	flock($fd, LOCK_EX);
	$messages[] = $new;
	file_put_contents($file, serialize($messages));
	flock($fd, LOCK_UN);
	fclose($fd);
	echo '<script langage="javascript">top.frames[\'chat\'].location = "chat.php";</script>';
}

?>

<html>
	<body>
		<form action="speak.php" method="post">
			<input type="text" name="msg" value="" autofocus/>
			<input type="submit" name="submit" value="OK"/>
		</form>
	</body>
</html>
