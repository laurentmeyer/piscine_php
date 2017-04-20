#!/usr/bin/php
<?php

if ($argc != 3
	|| !file_exists($argv[1]))
	return ;

$fd = fopen($argv[1], "r");
$headers = fgetcsv($fd, 0, ";");
$temp = array();
$index = array_search($argv[2], $headers);

if ($index === FALSE)
	return ;
while (($entry = fgetcsv($fd, 0, ";")) != FALSE)
	foreach ($entry as $key => $value)
		$temp[$headers[$key]][$entry[$index]] = $value;

//var_dump($temp);
//$$argv[2] = '$temp["' . $argv[2] . '"]';
$nom = '$temp["nom"]';
$prenom = '$temp["prenom"]';
$mail = '$temp["mail"]';
$IP = '$temp["IP"]';
$pseudo = '$temp["pseudo"]';

//echo $$argv[2];


echo "Entrez votre commande: ";
while ($entry = fgets(STDIN))
{
	$entry = trim($entry);
	if (strpos($entry, "rm ") !== FALSE)
		echo "tu te fous de ma gueule";
	else
	{
		$entry = str_replace('$nom[', '$temp["nom"][', $entry);
		$entry = str_replace('$prenom[', '$temp["prenom"][', $entry);
		$entry = str_replace('$mail[', '$temp["mail"][', $entry);
		$entry = str_replace('$IP[', '$temp["IP"][', $entry);
		$entry = str_replace('$pseudo[', '$temp["pseudo"][', $entry);
		eval($entry);
	}
	echo "Entrez votre commande: ";
}

?>

