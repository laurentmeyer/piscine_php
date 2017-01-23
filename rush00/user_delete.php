<?php
header("refresh:2; url=index.php");

include("auth.php");
include("db_selects.php");
include("db_updates.php");
include("db_deletes.php");
//$id = select_user_id($_POST['id']);
delete_user($_POST['id']);
echo "OK\n";

?>
