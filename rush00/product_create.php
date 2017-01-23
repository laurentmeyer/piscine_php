<?php
header("refresh:2; url=index.php");

include("auth.php");
include("db_selects.php");
include("db_updates.php");
include("db_deletes.php");
insert_product($_POST['name'], $_POST['img_path'], $_POST['price'], $_POST['description']);
echo "OK\n";

?>
