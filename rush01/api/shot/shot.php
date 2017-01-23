<?PHP
include_once("/db.php");
require_once("/class/Db.class.php");

$json = json_decode($_POST['tir']);
db::co;
$qry = mysqli::query("SELECT (charges, shape, sr, mr, lr) FROM weapons WHERE name=".$json['name']."\"");
$rep = $qry->fetch()[0];
$weap = new Weapon($rep);
$out = json_encode($weap->generateShot(intval($json['pp'])));
echo $out;
?>