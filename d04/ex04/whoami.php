<?php

session_start();
date_default_timezone_set("Europe/Paris");

if (($login = $_SESSION['loggued_on_user']) != NULL) {
	echo "$login\n";
} else {
	echo "ERROR\n";
}

?>
