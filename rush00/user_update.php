<?php
<?php
header("refresh:2; url=index.php");

include("auth.php");
include("db_selects.php");
include("db_updates.php");
$user_id = select_user_id($_POST['id']);
update_user($user_id);
echo "Utilisateur supprimé avec succès\n";

?>
