#!/usr/bin/php
<?php

function ft_remove_whitespace($str)
{
	$str = str_replace(" ", "", $str);
	$str = str_replace("\t", "", $str);
	return $str;
}

if ($argc != 2)
{
	echo "Incorrect Parameters\n";
	return ;
}

$str = ft_remove_whitespace($argv[1]);

if (!(($op_index = strpos($str, "+", 1))
	|| ($op_index = strpos($str, "-", 1))
	|| ($op_index = strpos($str, "*", 1))
	|| ($op_index = strpos($str, "/", 1))
	|| ($op_index = strpos($str, "%", 1))))
{
	echo "Syntax Error\n";
	return ;
}
$operator = $str[$op_index];
$operand1 = substr($str, 0, $op_index);
$operand2 = substr($str, $op_index + 1);
//echo $operator . "\n";
//echo $operand1 . "\n";
//echo $operand2 . "\n";

if (($operand1 || $operand1 === "0")
	&& $operator
	&& ($operand2 || $operand2 === "0")
	&& is_numeric($operand1) && is_numeric($operand2))
{
	if ($operator === "+")
		echo ($operand1 + $operand2)."\n";
	if ($operator === "-")
		echo ($operand1 - $operand2)."\n";
	if ($operator === "/")
	{
		if ($operand2 === "0")
			echo "Syntax Error\n";
		else
			echo ($operand1 / $operand2)."\n";
	}
	if ($operator === "*")
		echo ($operand1 * $operand2)."\n";
	if ($operator === "%" && $operand2 !== "0")
	{
		if ($operand2 === "0")
			echo "Syntax Error\n";
		else
			echo ($operand1 % $operand2)."\n";
	}
}
else
	echo "Syntax Error\n";

?>
