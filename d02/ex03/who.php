#!/usr/bin/php
<?php

date_default_timezone_set('Europe/Paris');
ini_set('display_errors', 1);

//   /Applications/Xcode.app/Contents/Developer//Platforms/MacOSX.platform/Developer/SDKs/MacOSX.sdk/usr/include/utmpx.h

$fd = fopen("/var/run/utmpx", "r");
$length = 256 + 4 + 32 + 4 + 2 + 2 + 4 + 4 + 256 + 16 * 4;

while (($str = fread($fd, $length)))
{
	$struct = unpack (
		"A256ut_user/".
		"A4ut_id/".
		"A32ut_line/".
		"iut_pid/".
		"sut_type/".
		"spad/".
		"Itv_sec/".
		"Itv_usec/".
		"A256ut_host/".
		"i16ut_pad",
		$str);
	if ($struct["ut_type"] == 7)
	{
		//var_dump($struct);
		printf("%-7s  %-7s  %s\n",
			$struct["ut_user"],
			$struct["ut_line"],
			date("M  j H:i", $struct["tv_sec"]));
	}
}

fclose ($fd);

?>
