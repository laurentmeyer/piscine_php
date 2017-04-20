#!/usr/bin/php
<?php

if ($argc > 2)
{
	array_shift($argv);
	$to_find = array_shift($argv);
	foreach ($argv as $arg)
	{
		$exploded = explode(":", $arg);
		$keyvalues[$exploded[0]] = $exploded[1];
	}
	if (array_key_exists($to_find, $keyvalues))
		echo $keyvalues[$to_find]."\n";
}

?>
