<?php

date_default_timezone_set("Europe/Paris");
include('data.php');

function auth($login, $passwd)
{
	global $hashalgo;
	if ($login == NULL || $passwd == NULL)
			return (FALSE);
	
	$passwd = hash($hashalgo, $passwd);
	$users = get_all_users();
	
	foreach ($users as $key => $value)
		if ($value['login'] == $login && $value['passwd'] == $passwd)
			return (TRUE);
	
	return (FALSE);
}

function is_admin($login)
{
	$users = get_all_users();
	foreach ($users as $value)
		if ($value['login'] == $login && $value['admin'] == 1)
			return (TRUE);
	return (FALSE);
}

?>