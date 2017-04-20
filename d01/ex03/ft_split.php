<?php 

function ft_split($str)
{
	$str = trim($str);
	while (strpos($str, "  "))
		$str = str_replace("  ", " ", $str);
	$array = explode(" ", $str);
	sort($array);
	return $array;
}

?>
