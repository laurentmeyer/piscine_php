#!/usr/bin/php
<?php

function ft_is_sort($array) {
	if (!is_array($array))
		return (FALSE);
	else if (count($array) < 2)
		return (TRUE);
	$i = 0;
	while (++$i < count($array))
		if (strcmp($array[$i], $array[$i - 1]) < 0)
			return (FALSE);
	return (TRUE);
}
