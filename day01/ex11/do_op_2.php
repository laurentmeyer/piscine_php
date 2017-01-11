#!/usr/bin/php
<?php

if ($argc != 2)
{
	echo "Incorrect Parameters\n";
	return ;
}

$str = preg_replace("/( |\t)/", "", $argv[1]);

preg_match("/[0-9](\%|\/|\-|\*|\+)/", $str, $matches);
$operator = $matches[1];
preg_match("/^(.*[0-9])[\%|\/|\-|\*|\+]/", $str, $matches);
$operand1 = $matches[1];
preg_match("/[0-9][\%|\/|\-|\*|\+](.*)$/", $str, $matches);
$operand2 = $matches[1];

if ($operand1 && $operator && $operand2
	&& is_numeric($operand1) && is_numeric($operand2))
{
	if ($operator === "+")
		echo ($operand1 + $operand2)."\n";
	if ($operator === "-")
		echo ($operand1 - $operand2)."\n";
	if ($operator === "/")
		echo ($operand1 / $operand2)."\n";
	if ($operator === "*")
		echo ($operand1 * $operand2)."\n";
	if ($operator === "%")
		echo ($operand1 % $operand2)."\n";
}
else
	echo "Syntax Error\n";

?>
