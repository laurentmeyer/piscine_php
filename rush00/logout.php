<?php
header("refresh:3; url=index.php");
session_start();
$_SESSION['loggued_on_user'] = "";
echo "Au revoir !\n";
?>
