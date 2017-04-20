<?php

date_default_timezone_set("Europe/Paris");

$msg_folder = "../private/";
$msg_file = "chat";
$file = $msg_folder . $msg_file;

$messages = unserialize(file_get_contents($file));

foreach($messages as $mes)
	echo "[" . date('H:i', $mes['time']) . "] <b>" . $mes['login'] . "</b>: " . $mes['msg'] . "<br />\n";

?>
