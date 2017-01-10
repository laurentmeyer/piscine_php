#!/usr/bin/php
<?php

if ($str = $argv[1])
{
	$str = preg_replace("/^ */", "", $str);
	$str = preg_replace("/ +/", " ", $str);
	$str = preg_replace("/ *$/", "", $str);
	echo "$str\n";
}
