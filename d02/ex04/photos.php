#!/usr/bin/php
<?php

date_default_timezone_set('Europe/Paris');
ini_set('display_errors', 1);

if ($argc != 2)
	return ;

$domain = $argv[1];
if (preg_match("|http://|i", $domain))
	$domain = substr($domain, 7);
else if (preg_match("|https://|i", $domain))
	$domain = substr($domain, 8);

if (!is_dir($domain))
	if (!mkdir($domain, 0777, 1))
		echo 'Problem creating the dir\n';



$content = shell_exec('curl -s ' . $argv[1]);
preg_match_all("|<img .*src=\"([^\"]*)\".*>|m", $content, $matches);
foreach($matches[1] as $img)
{
	if (!preg_match("|https?://|i", $img))
		$path = ($img[0] === "/") ? $argv[1] . $img : $argv[1] . "/" . $img;
	else
		$path = $img;
	$img_name = substr($path, strrpos($path, "/") + 1);
	copy($path, $domain . "/" . $img_name);
}



?>
