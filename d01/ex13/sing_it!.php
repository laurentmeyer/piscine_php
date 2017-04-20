#!/usr/bin/php
<?php

//date_default_timezone_set(UTC);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if ($argc > 1)
{
	if ($argv[1] === "mais pourquoi cette demo ?")
		echo "Tout simplement pour qu'en feuilletant le sujet" . "\n" . "on ne s'apercoive pas de la nature de l'exo" . "\n";
	if ($argv[1] === "mais pourquoi cette chanson ?")
		echo "Parce que Kwame a des enfants" . "\n";
	if ($argv[1] === "vraiment ?")
	{
		if (file_exists(getcwd() . "/really"))
			echo "Oui il a vraiment des enfants" . "\n";
		else
		{
			echo "Nan c'est parce que c'est le premier avril" . "\n";
			file_put_contents(getcwd() . "/really", "", 0);
		}
	}
}

?>
