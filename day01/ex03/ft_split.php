<?php 

function ft_split($str)
{
	$array = preg_split("/ +/", $str, -1, PREG_SPLIT_NO_EMPTY);
	sort($array);
	return $array;
}

?>
