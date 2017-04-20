<?php

function ft_is_sort($array) {
	if (!is_array($array))
		return (FALSE);
	else if (count($array) < 2)
		return (TRUE);
	$sign = $array[0] < $array[1] ? 1 : -1;
	$i = 0;
	while (++$i < count($array))
		if (strcmp($array[$i], $array[$i - 1]) * $sign < 0)
			return (FALSE);
	return (TRUE);
}
