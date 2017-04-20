<?php

ini_set('display_errors', 1);
date_default_timezone_set("Europe/Paris");

//rename('./docs', '/docs');

function csv_to_array( $filename )
{
	$ret = array();
	$fd = fopen($filename, "r");
	$headers = fgetcsv($fd);
	while (($entry = fgetcsv($fd)) !== FALSE)
	{
		$temp = array();
		foreach ($entry as $key => $value)
			$temp[$headers[$key]] = $value;
		$ret[] = $temp;
	}
	fclose($fd);
	return ($ret);
}

$files = array('categories', 'categories_products', 'products', 'users', 'orders');

array_map(function ($table) {
	$docpath = dirname(__FILE__) .'/docs/';
	$path = $docpath . $table;
	$ext = '.serial';
	file_put_contents($path . $ext, serialize(csv_to_array($path . '.csv')));
}, $files);

include('auth.php');
create_user('root', 'root', 1);
create_user('lucas', 'lucas', 1);
create_user('laurent', 'laurent', 1);
modif_user('laurent', 'laurent', 'loulou', 1);

create_product('caniche', 'http://www.chiens-de-france.com/photo/chiens/2010_06/chiens-Caniche-229eb461-2a2a-b254-6d90-7dbb42656f95.jpg', 'ceci n\'est pas un canif', '100');
create_product('canif', 'http://www.prixcanon.fr/1813-thickbox/canif-pliant-pince-a-billet-herbertz-noir-araignee-manche-65-cm.jpg', 'ceci n\'est pas un caniche', '12');
create_product('file dentaire', 'http://www.papilli.fr/77-196-large/papilli-flosser-.jpg', 'c\'est un bon file dentaire', '1.02');
create_product('coupe-oeuf', 'https://media.mathon.fr/Images/Produitsv2/Amazon/27005_0_1_-Coupe-oeuf-coque.jpg', 'uniquement par le petit bout', '42');
modif_product('voiture', 'fusee', 'on ne dirait pas mais c\'est une fusée', '', '');

create_category('manger');
modif_category('superflu', 'top cool');
delete_category('ewfwef');

create_link('manger', 'coupe-oeuf');

?>
