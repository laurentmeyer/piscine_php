<?php
header("refresh:2; url=index.php");

include("auth.php");
include("db_selects.php");
include("db_updates.php");
include("db_deletes.php");
update_category($_POST['id'], $_POST['name']);
echo "OK\n";

?>