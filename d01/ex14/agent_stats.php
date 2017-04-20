#!/usr/bin/php
<?php

if ($argc != 2
	|| ($argv[1] !== "moyenne" && $argv[1] !== "moyenne_user" && $argv[1] !== "ecart_moulinette")
	|| !($line = trim(fgets(STDIN))))
	return ;
$headers = explode(";", $line);

while (($line = trim(fgets(STDIN))))
{
	$values = explode(";", $line);
	foreach ($headers as $index => $field)
		$array[$field] = $values[$index];
	$csv[] = $array;
}

if ($argv[1] === "moyenne")
{
	$sum = 0;
	$count = 0;
	foreach ($csv as $grade)
	{
		if ($grade["Note"] !== "" && $grade["Noteur"] !== "moulinette")
		{
			$sum += (int)$grade["Note"];
			$count++;
		}
	}
	$mean = $sum / $count;
	echo $mean . "\n";
	return ;
}

$mean_student = array();
foreach ($csv as $grade)
{
	if ($grade["Noteur"] !== "moulinette")
	{
		if ($grade["Note"] !== "")
		{
			if (!array_key_exists($grade["User"], $mean_student))
			{
				$mean_student[$grade["User"]]["Sum"] = $grade["Note"];
				$mean_student[$grade["User"]]["Count"] = 1;
				$mean_student[$grade["User"]]["Mean"] = $grade["Note"];
			}
			else
			{
				$mean_student[$grade["User"]]["Sum"] += (int)$grade["Note"];
				++$mean_student[$grade["User"]]["Count"];
				$mean_student[$grade["User"]]["Mean"] = $mean_student[$grade["User"]]["Sum"] / $mean_student[$grade["User"]]["Count"];
			}
		}
	}
}
foreach ($csv as $grade)
	if (array_key_exists($grade["User"], $mean_student) && $grade["Noteur"] === "moulinette")
		$mean_student[$grade["User"]]["Moulinette"] = $grade["Note"];

ksort($mean_student);

if ($argv[1] === "moyenne_user")
{
	foreach ($mean_student as $key => $student)
		echo $key . ":" . $student["Mean"] . "\n";
	return ;
}

if ($argv[1] === "ecart_moulinette")
{
	foreach ($mean_student as $key => $student)
		if (array_key_exists("Moulinette", $student))
			echo $key . ":" . ($student["Mean"] - $student["Moulinette"]) . "\n";
	return ;
}

?>
