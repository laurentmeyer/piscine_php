#!/usr/bin/php
<?php

$fd = fopen("/var/run/utmpx", "r");
echo fgets($fd);
$data = fread($fd, 8);
$header = unpack ("C1highbit/".
	"A3signature/".
	"C2lineendings/".
	"C1eof/".
	"C1eol", $data);
print_r($header);
$data = fread ($fh, 8);
$chunk = unpack ("N1length/A4type", $data);
//while (($str = fgets($fd)) != FALSE)
//echo $array[1];
fclose ($fd);

?>
