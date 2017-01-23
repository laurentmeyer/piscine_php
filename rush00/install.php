<?php

$host_name = "localhost";
$dbname = "rushDB";
$username = "username";
$password = "password";

include("db_init.php");

db_destroy_db();
db_init();
db_create_tables();

include("db_inserts.php");
include("db_selects.php");
include("db_describes.php");
include("db_updates.php");
insert_user("admin", "root");
update_user(select_user_id("admin"), "admin", "root", "1");
insert_user("coucou", "bouzin");
insert_user("didier", "super");
insert_user("toto", "toto");
insert_category("Tout");
insert_category("Maison");
insert_category("Enfant");
insert_category("Jardin");
insert_product("Chaise", "img/chaise.png", "12.50", "Ceci est une super belle chaise de designer. Elle est belle.");
insert_product("Enfant", "img/enfant.png", "42", "Ceci est un enfant à usage multiple. Attention, peut pleurer.");
insert_product("Allumette", "http://ekladata.com/Q7Fg10Q0xsJaCq62yPP1a8AoVQE.png", "0.01", "Cette allumette à usage unique vous servira une fois au mieux");
insert_product("Canard", "img/canard.png", "8.3", "Ce canard est un canard vivant. Il flotte mais ne coule pas");
insert_product("Chevalier qui dit ni", "img/knight.png", "14990", "Ce chavalier dit aussi eki eki pa tong, mais seulement dans les jardinets");
link_product_category("Chaise", "Jardin");
link_product_category("Chaise", "Maison");
link_product_category("Chaise", "Enfant");
link_product_category("Chevalier qui dit ni", "Enfant");
link_product_category("Canard", "Enfant");
link_product_category("Allumette", "Enfant");
link_product_category("Allumette", "Maison");
link_product_category("Canard", "Jardin");


//$array = select_product("Chaise");
//while (($row = mysqli_fetch_assoc($array)) != NULL)
//	print_r($row);
//echo "========================\n";
//$array = select_all_category_products("3");
//while (($row = mysqli_fetch_assoc($array)) != NULL)
//	print_r($row);
//echo "========================\n";
//$array = select_all_product_categories("5");
//while (($row = mysqli_fetch_assoc($array)) != NULL)
//	print_r($row);


//echo "========================\n";
//$array = table_fields("Products");
//foreach ($array as $field)
//	echo "$field\n";











////$elt1 = "ca";
////$str = "salut $elt1 va?";
////echo $str;

//$conn = mysqli_connect("localhost", "username", "password", "rushDB");
//if (!$conn) {
//	die("Connection failed: " . mysqli_connect_error()) . "\n";
//}
//
//$name = "Allumette";
//$img_path = "/img/allumette.png";
//$price = "0.05";
//
//$sql = 'INSERT INTO Products (name, img_path, price) VALUES ("$name", "$img_path", "$price");';
//$sql = preg_replace_callback('#\"(\$[^\"]*)\"#u', function ($matches) {
//	return ("mysqli_real_escape_string(" . '$conn' .", $matches[1])");
//},	$sql);
//$sql = "\"" . $sql . "\"";
//echo $sql;
//eval(" echo \"RESULT = \" . $sql . \"\n\";");

////if (($array = mysqli_query($conn, $sql)) != NULL) {
////	echo "Successfully selected\n";
////} else {
////	echo "Error : " . mysqli_error($conn);
////}
////
////mysqli_close($conn);
////
////while (($row = mysqli_fetch_assoc($array)) != NULL) {
////	print_r($row);
////}
//
//?>
