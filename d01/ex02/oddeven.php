#!/usr/bin/php
<?php 

echo "Entrez ", "un nombre: ";
while ($entry = fgets(STDIN))
{
	$number = trim($entry);
	if (is_numeric($number))
		echo "Le chiffre ", $number, " est ", $number % 2 == 0 ? "Pair" : "Impair", "\n";
	else
		echo "'$number' n'est pas un chiffre\n";
	echo "Entrez un nombre: ";
}
echo "\n";

?>
