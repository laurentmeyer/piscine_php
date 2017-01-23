<?php

function select_product($name)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$name = mysqli_real_escape_string($conn, $name);
	$sql = "SELECT * FROM Products WHERE name='$name';";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
	return ($array);
}

function select_user_id($login)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$login = mysqli_real_escape_string($conn, $login);
	$sql = "SELECT id FROM Users WHERE login='$login';";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}
	if (($row = mysqli_fetch_assoc($array)) != NULL)
		$ret = $row['id'];

	mysqli_close($conn);
	return ($ret);
}

function select_category_id($name)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$name = mysqli_real_escape_string($conn, $name);
	$sql = "SELECT id FROM Categories WHERE name='$name';";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}
	if (($row = mysqli_fetch_assoc($array)) != NULL)
		$ret = $row['id'];

	mysqli_close($conn);
	return ($ret);
}

function select_product_id($name)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$name = mysqli_real_escape_string($conn, $name);
	$sql = "SELECT id FROM Products WHERE name='$name';";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}
	if (($row = mysqli_fetch_assoc($array)) != NULL)
		$ret = $row['id'];

	mysqli_close($conn);
	return ($ret);
}

function select_all_categories()
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error()) . "\n";

	$sql = "SELECT * FROM Categories;";
	if (($array = mysqli_query($conn, $sql)) == NULL)
		echo "Error : " . mysqli_error($conn);
	mysqli_close($conn);
	return ($array);
}

function select_all_category_products($c_id)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error()) . "\n";

	$c_id = mysqli_real_escape_string($conn, $c_id);
	$sql = "SELECT P.*
		FROM Products AS P
		INNER JOIN Categories_Products AS CP
		ON P.id=CP.p_id
		WHERE CP.c_id=$c_id
		;";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
	return ($array);
}

function select_all_product_categories($p_id)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error()) . "\n";

	$p_id = mysqli_real_escape_string($conn, $p_id);
	$sql = "SELECT C.*
		FROM Categories AS C
		INNER JOIN Categories_Products AS CP
		ON C.id=CP.c_id
		WHERE CP.p_id=$p_id
		;";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
	return ($array);
}

function select_no_product_categories($p_id) {
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error()) . "\n";

	$p_id = mysqli_real_escape_string($conn, $p_id);
	$sql = "SELECT C.*
		FROM Categories AS C  
		LEFT JOIN (SELECT CP.*
		FROM Categories_Products CP
		WHERE CP.p_id=$p_id) AS E
		ON C.id = E.c_id
		WHERE c_id IS NULL
		;";
		//LEFT JOIN Categories AS C 
		//ON C.id=CP.c_id

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
	return ($array);
}


function select_all_products()
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$sql = "SELECT * FROM Products;";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
	return ($array);
}

?>
