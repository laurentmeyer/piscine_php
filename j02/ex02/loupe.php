#!/usr/bin/php
<?php

if ($argc !=2 || ($str = file_get_contents($argv[1])) == FALSE)
	return ;
$str = preg_replace_callback('#(<a[^>]*>)([^<]*)(<)#u', function ($matches) {
	return ($matches[1].strtoupper($matches[2]).$matches[3]);
},	$str);
$str = preg_replace_callback('#(<[a|img][^>]* title=")([^"]*)(")#u', function ($matches) {
	return ($matches[1].strtoupper($matches[2]).$matches[3]);
},	$str);
echo $str;

?>
