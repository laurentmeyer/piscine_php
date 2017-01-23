<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/class/Db.class.php");
header("Content-Type: application/json");

$lol = Db::getChat();

$toto = [];

foreach ($lol as $line)
{
 	$tab = explode(" : ", $line);
    array_push($toto,[ $tab[0] => $tab[1] ]);
}
echo json_encode($toto, JSON_FORCE_OBJECT)
?>
