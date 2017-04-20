<?php

session_start();

if (($login = $_SESSION['loggued_on_user']) != NULL) {
	echo "$login\n";
} else {
	echo "ERROR\n";
}

?>
