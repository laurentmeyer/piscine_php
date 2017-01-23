#!/usr/bin/php
<?php

if ($argc != 4)
{
	echo "Incorrect Parameters\n";
	return ;
}
array_shift($argv);
foreach($argv as &$argument)
	$argument = trim($argument);
if ($argv[1] === "+")
	echo ($argv[0] + $argv[2])."\n";
if ($argv[1] === "-")
	echo ($argv[0] - $argv[2])."\n";
if ($argv[1] === "%")
	echo ($argv[0] % $argv[2])."\n";
if ($argv[1] === "*")
	echo ((int)$argv[0] * $argv[2])."\n";
if ($argv[1] === "/")
	echo ($argv[0] / $argv[2])."\n";

?>
