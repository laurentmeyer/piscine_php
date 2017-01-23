<?php

session_start();

if ($_POST['submit'] !="OK"
	|| ($passwd = $_POST['passwd']) == NULL
	|| ($login  = $_POST['login']) == NULL) {
		echo "ERROR\n";
		return ;
	}

$foldername = $_SERVER['DOCUMENT_ROOT'] . "/private/";
$filename = $foldername . "passwd";
$hashalgo = "sha512";
$passwd = hash($hashalgo, $passwd);

if (!file_exists($filename)) {
	if (!file_exists($foldername))
		mkdir($foldername);
	$users_array = [];
} else {
	$str = file_get_contents($filename);
	$users_array = unserialize($str);
	foreach ($users_array as $entry)
		if ($entry['login'] == $login) {
			echo "ERROR\n";
			return ;
		}
}
$entry = [];
$entry['login'] = $login;
$entry['passwd'] = $passwd;
$users_array[] = $entry;
$str = serialize($users_array);
echo (file_put_contents($filename, $str)) ? "OK\n" : "ERROR\n";
