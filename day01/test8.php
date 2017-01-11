#!/usr/bin/php
<?PHP

include("ex08/ft_is_sort.php");

//$tab = array("!/@#;^", "42", "Hello World", "salut", "zZzZzZz");
$tab = "abc";
if (ft_is_sort($tab))
	echo "Le tableau est trie\n";
else
	echo "Le tableau n’est pas trie\n";

?>
