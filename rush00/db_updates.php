<?php

function update_user($id, $login, $passwd, $admin)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		return(mysqli_connect_error());

	$id = mysqli_real_escape_string($conn, $id);
	$login = mysqli_real_escape_string($conn, $login);
	$passwd = hash("whirlpool", $passwd);
	$admin = mysqli_real_escape_string($conn, $admin);

	$sql = "UPDATE Users
		SET login='$login', passwd='$passwd', admin='$admin'
		WHERE id='$id';";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		$ret = mysqli_error($conn);
	} else {
		$ret = "OK";
	}

	mysqli_close($conn);
	return ($ret);
}

function update_product($id, $name, $img_path, $price, $description)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$namecpy = $name;
	$id = mysqli_real_escape_string($conn, $id);
	$name = mysqli_real_escape_string($conn, $name);
	$img_path = mysqli_real_escape_string($conn, $img_path);
	$price = mysqli_real_escape_string($conn, $price);
	$description = mysqli_real_escape_string($conn, $description);

	$sql = "UPDATE Products
		SET name='$name', 'img_path='$img_path', price='$price', description='$description'
		WHERE id='$id';";

	if (mysqli_query($conn, $sql)) {
		echo "Successfully updated\n";
	} else {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
}

function update_category($id, $name)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$id = mysqli_real_escape_string($conn, $id);
	$name = mysqli_real_escape_string($conn, $name);
	$sql = "UPDATE Categories
		SET name = '$name'
		WHERE id='$id';";

	if (mysqli_query($conn, $sql)) {
		echo "Successfully created\n";
	} else {
		echo "Error : " . mysqli_error($conn);
	}

	mysqli_close($conn);
}

?>
