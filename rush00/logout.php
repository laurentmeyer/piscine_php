<?php

session_start();
date_default_timezone_set("Europe/Paris");

$_SESSION['loggued_on_user'] = "";
header("Location: index.php");
?>