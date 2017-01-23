<?php

function insert_category($name)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$name = mysqli_real_escape_string($conn, $name);

	$sql = "INSERT INTO Categories (name)
		VALUES ('"
		. $name
		. "')";

	if (mysqli_query($conn, $sql)) {
		echo "Successfully created\n";
	} else {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
}

function link_product_category($prodname, $catname)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$prodname = mysqli_real_escape_string($conn, $prodname);
	$catname = mysqli_real_escape_string($conn, $catname);
	$sql = "SELECT * FROM Products WHERE name='$prodname';";
	if (($array = mysqli_query($conn, $sql)) == NULL)
		echo "Error : " . mysqli_error($conn);
	if (($row = mysqli_fetch_assoc($array)) != NULL)
		$p_id = $row['id'];

	$sql = "SELECT id FROM Categories WHERE name='$catname';";
	if (($array = mysqli_query($conn, $sql)) == NULL)
		echo "Error : " . mysqli_error($conn);
	if (($row = mysqli_fetch_assoc($array)) != NULL)
		$c_id = $row['id'];

	$sql = "INSERT INTO Categories_Products (c_id, p_id)
		VALUES ('"
		. $c_id . "','"
		. $p_id
		. "')";
	if (!mysqli_query($conn, $sql))
		echo "Error : " . mysqli_error($conn);
	if (($row = mysqli_fetch_assoc($array)) != NULL)
		$p_id = $row['id'];

	mysqli_close($conn);
}

function insert_product($name, $img_path, $price, $description)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$namecpy = $name;
	$name = mysqli_real_escape_string($conn, $name);
	$img_path = mysqli_real_escape_string($conn, $img_path);
	$price = mysqli_real_escape_string($conn, $price);
	$description = mysqli_real_escape_string($conn, $description);

	$sql = "INSERT INTO Products (name, img_path, price, description)
		VALUES ('"
		. $name . "','"
		. $img_path . "','"
		. $price . "','"
		. $description
		. "')";

	if (mysqli_query($conn, $sql)) {
		echo "Successfully added\n";
	} else {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
	link_product_category($namecpy, "Tout");
}

function insert_user($login, $passwd) {
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		return(mysqli_connect_error());

	$login = mysqli_real_escape_string($conn, $login);
	$passwd = hash("whirlpool", $passwd);
	$sql = "INSERT INTO Users (login, passwd, admin)
		VALUES ('"
		. $login . "','"
		. $passwd . "','"
		. '0'
		. "')";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		$ret = mysqli_error($conn);
	} else {
		$ret = "OK";
	}

	mysqli_close($conn);
	return ($ret);
}

