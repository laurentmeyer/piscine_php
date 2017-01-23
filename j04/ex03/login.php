<?php

include("auth.php");

session_start();

if (($login = $_GET['login']) == NULL
	|| ($passwd = $_GET['passwd']) == NULL
	|| !auth($login, $passwd)) {
		$_SESSION['loggued_on_user'] = "";
		echo "ERROR\n";
		return ;
	} else {
		$_SESSION['loggued_on_user'] = $login;
		echo "OK\n";
		return ;
	}

?>
