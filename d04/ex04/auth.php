<?php

date_default_timezone_set("Europe/Paris");
function auth($login, $passwd) {

if ($login == NULL
	|| $passwd == NULL)
	return (FALSE);

$hashalgo = "sha512";
$passwd = hash($hashalgo, $passwd);

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

foreach ($array as $key => $value) {
	if ($value['login'] == $login && $value['passwd'] == $passwd)
		return (TRUE);
}

return (FALSE);
}

?>
