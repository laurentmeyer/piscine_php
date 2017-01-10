#!/usr/bin/php
<?php

function ft_split($str)
{
	$array = preg_split("/ +/", $str, -1, PREG_SPLIT_NO_EMPTY);
	sort($array);
	return $array;
}

array_shift($argv);
if (!empty($argv))
{
	array_map(
		function ($s) {
			echo "$s\n";
		}, ft_split(implode(" ", $argv)));
}
