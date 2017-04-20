#!/usr/bin/php
<?php

date_default_timezone_set(UTC);

function what_month($str)
{
	if (preg_match("/^[J|j]anvier$/", $str))
		return (1);
	if (preg_match("/^[F|f][é|e]vrier$/u", $str))
		return (2);
	if (preg_match("/^[M|m]ars$/", $str))
		return (3);
	if (preg_match("/^[A|a]vril$/", $str))
		return (4);
	if (preg_match("/^[M|m]ai$/", $str))
		return (5);
	if (preg_match("/^[J|j]uin$/", $str))
		return (6);
	if (preg_match("/^[J|j]uillet$/", $str))
		return (7);
	if (preg_match("/^[A|a]o[û|u]t$/u", $str))
		return (8);
	if (preg_match("/^[S|e]eptembre$/", $str))
		return (9);
	if (preg_match("/^[O|o]ctobre$/", $str))
		return (10);
	if (preg_match("/^[N|n]ovembre$/", $str))
		return (11);
	if (preg_match("/^[D|d][é|e]cembre$/u", $str))
		return (12);
	return (-1);
}

function what_day($str)
{
	if (preg_match("/^[D|d]imanche$/", $str))
		return (0);
	if (preg_match("/^[L|l]undi$/", $str))
		return (1);
	if (preg_match("/^[M|m]ardi$/", $str))
		return (2);
	if (preg_match("/^[M|m]ercredi$/", $str))
		return (3);
	if (preg_match("/^[J|j]eudi$/", $str))
		return (4);
	if (preg_match("/^[V|v]endredi$/", $str))
		return (5);
	if (preg_match("/^[S|s]amedi$/", $str))
		return (6);
	return (-1);
}

if ($argc != 2)
	return ;
if (preg_match("/^([a-zA-Z|\p{L}]+) (\d?\d) ([a-zA-Z|\p{L}]+) (\d\d\d\d) (\d\d):(\d\d):(\d\d)/u", trim($argv[1]), $match) == TRUE
	&& ($month = what_month($match[3])) != -1
	&& ($day_name = what_day($match[1])) != -1)
{
	$day_number = $match[2];
	$year = $match[4];
	$hour = $match[5];
	$minute = $match[6];
	$second = $match[7];
	$res = mktime($hour, $minute, $second, $month, $day_number, $year, 1);
	if ($day_name == date("w", $res))
		echo "$res\n";
	else
		echo "Wrong Format\n";
}
else
	echo "Wrong Format\n";

?>
