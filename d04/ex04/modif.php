<?php

session_start();
date_default_timezone_set("Europe/Paris");

if (($login = $_POST['login']) == NULL
	|| ($oldpw = $_POST['oldpw']) == NULL
	|| ($newpw = $_POST['newpw']) == NULL
	|| $_POST['submit'] !="OK")
{
	echo "ERROR\n";
	return ;
}

$hashalgo = "sha512";
$oldpw = hash($hashalgo , $oldpw);
$newpw = hash($hashalgo, $newpw);
$foldername = "../private/";
$file = $foldername . "passwd";

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

$str = file_get_contents($file);
$array = unserialize($str);

foreach ($array as $key => $value)
{
	if ($value['login'] == $login)
	{
		if ($value['passwd'] != $oldpw)
		{
			echo "ERROR\n";
			return ;
		}
		$array[$key]['passwd'] = $newpw;
		$str = serialize($array);
		if (file_put_contents($file, $str))
		{
			header("Location: index.html");
			echo "OK\n";
			return ;
		}
	}
}
echo "ERROR\n";
return ;

?>
