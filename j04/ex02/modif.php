<?php

session_start();

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
$foldername = $_SERVER['DOCUMENT_ROOT'] . "/private/";
$filename = $foldername . "passwd";

$str = file_get_contents($filename);
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
		echo file_put_contents($filename, $str) ? "OK\n" : "ERROR\n";
		return ;
	}
}
echo "ERROR\n";
return ;

?>
