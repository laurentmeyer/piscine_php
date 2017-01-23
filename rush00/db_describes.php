<?php

function table_fields($name)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error()) . "\n";

	$name = mysqli_real_escape_string($conn, $name);
	$sql = "DESCRIBE $name";
	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}
	$names = [];
	while (($row = mysqli_fetch_assoc($array)) != NULL)
		$names[] = $row['Field'];
	mysqli_close($conn);
	return ($names);
}

?>
