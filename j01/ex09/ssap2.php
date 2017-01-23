#!/usr/bin/php
<?php

function cmp($a, $b)
{
	if ($a == NULL && $b == NULL)
		return (0);
	if ($a == NULL)
		return (-1);
	if ($b == NULL)
		return (1);
	if (strtolower($a[0]) === strtolower($b[0]))
		return (cmp(substr($a, 1), substr($b, 1)));
	if (ctype_alpha($a[0]))
	{
		if (!ctype_alpha($b[0]))
			return (-1);
		return (strcmp(strtolower($a[0]), strtolower($b[0])));
	}
	if (ctype_digit($a[0]))
	{
		if (ctype_alpha($b[0]))
			return (1);
		if (!ctype_alnum($b[0]))
			return (-1);
		return (strcmp($a[0], $b[0]));
	}
	if (ctype_alnum($b[0]))
		return (1);
	return (strcmp($a[0], $b[0]));
}


function ft_split($str)
{
	$array = preg_split("/ +/", $str, -1, PREG_SPLIT_NO_EMPTY);
	usort($array, "cmp");
	return $array;
}

array_shift($argv);
if (!empty($argv))
	foreach(ft_split(implode(" ", $argv)) as $elem)
			echo "$elem\n";

?>
