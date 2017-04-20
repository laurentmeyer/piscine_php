#!/usr/bin/php
<?php

function replace_upper ($matches)
{
	return ($matches[1].strtoupper($matches[2]).$matches[3]);
}

if ($argc !=2 || ($str = file_get_contents($argv[1])) == FALSE)
	return ;

$starta = 0;
$res = "";

while (($starta = strpos($str, "<a ")) !== FALSE)
{
	$res = $res . substr($str, 0, $starta);
	$str = substr($str, $starta);
	$endtag = strpos($str, "</a>");
	$content = substr($str, 0, $endtag + 4);
	$content = preg_replace_callback('#(>)([^<]*)(<)#u', replace_upper, $content);
	$content = preg_replace_callback('#(=")([^"]*)(")#u', replace_upper, $content);

	$res = $res . $content;
	$str = substr($str, $endtag + 4);
	
}

echo $res . "\n";

?>
