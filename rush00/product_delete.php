<?php
header("refresh:2; url=index.php");

include("auth.php");
include("db_selects.php");
include("db_updates.php");
include("db_deletes.php");
delete_product($_POST['id']);
echo "OK\n";

?>
