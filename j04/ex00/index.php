<?php

session_start();

if ($_GET['submit'] =="OK")
{
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}

echo "<html><body>\n"
. "<form action=\".\" method=\"get\" autocomplete=\"on\">\n"
. "	Identifiant: <input type=\"text\" name=\"login\" value=\""
. $_SESSION['login']
. "\" />\n"
. "	<br />\n"
. "	Mot de passe: <input type=\"password\" name=\"passwd\" value=\""
. $_SESSION['passwd']
. "\" />\n"
. "	<input type=\"submit\" name=\"submit\" value=\"OK\"/>\n"
. "</form>\n"
. "</body></html>\n";

?>
