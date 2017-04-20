<?php

session_start();
date_default_timezone_set("Europe/Paris");

if ($_POST['submit'] !="OK"
	|| ($passwd = $_POST['passwd']) == NULL
	|| ($login  = $_POST['login']) == NULL)
{
	echo "ERROR\n";
	return ;
}

$foldername = "../private/";
$file = $foldername . "passwd";
$hashalgo = "sha512";
$passwd = hash($hashalgo, $passwd);

if (!file_exists($file))
{
	if (!file_exists($foldername))
		mkdir($foldername);
	$users_array = [];
}
else
{
	$str = file_get_contents($file);
	$users_array = unserialize($str);
	foreach ($users_array as $entry)
		if ($entry['login'] == $login)
		{
			echo "ERROR\n";
			return ;
		}
}
$entry = [];
$entry['login'] = $login;
$entry['passwd'] = $passwd;
$users_array[] = $entry;
$str = serialize($users_array);
if (file_put_contents($file, $str))
{
	header("Location: index.html");
	echo "OK\n";
}
else
	echo "ERROR\n";

?>
