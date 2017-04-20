<?php

function auth($login, $passwd) {

if ($login == NULL
	|| $passwd == NULL)
	return (FALSE);

$hashalgo = "sha512";
$passwd = hash($hashalgo, $passwd);
$foldername = "../private/";
$filename = $foldername . "passwd";

$str = file_get_contents($filename);
$array = unserialize($str);

foreach ($array as $key => $value) {
	if ($value['login'] == $login && $value['passwd'] == $passwd)
		return (TRUE);
}

return (FALSE);
}

?>
