<?php

function delete_user($id)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		return(mysqli_connect_error());

	$id = mysqli_real_escape_string($conn, $id);
	$sql = "DELETE FROM Users
		WHERE id='$id';";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		$ret = mysqli_error($conn);
	} else {
		$ret = "OK";
	}

	mysqli_close($conn);
	return ($ret);
}

function delete_product($id)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$id = mysqli_real_escape_string($conn, $id);
	$sql = "DELETE FROM Products
		WHERE id='$id';";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		$ret = mysqli_error($conn);
	} else {
		$ret = "OK";
	}

	mysqli_close($conn);
	return ($ret);
}

function delete_category($id)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$id = mysqli_real_escape_string($conn, $id);
	$sql = "DELETE FROM Categories
		WHERE id='$id';";

	if (($array = mysqli_query($conn, $sql)) == NULL) {
		$ret = mysqli_error($conn);
	} else {
		$ret = "OK";
	}

	mysqli_close($conn);
	return ($ret);
}


?>
