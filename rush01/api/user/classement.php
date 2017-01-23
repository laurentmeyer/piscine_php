<?php
header("Content-Type: application/json");
require_once('../../class/Db.class.php');

$classement = Db::getClassement();
$tab2 = [];
foreach ($classement as $user) {
    $line = explode("|", $user);
    array_push($tab2,[ 'joueur' => $line[0] , 'count' => $line[1], 'win' => $line[2] , 'lost' => $line[3] ,'elo' => $line[4] ]);
}
foreach($tab2 as $line) {
    $tab3[] = $line;
}
echo json_encode($tab2, JSON_FORCE_OBJECT);
?>