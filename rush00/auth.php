<?php

function auth($login, $passwd)
{
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn)
		return(mysqli_connect_error());

	$login = mysqli_real_escape_string($conn, $login);
	$passwd = hash("whirlpool", $passwd);
	$sql = "SELECT *
		FROM Users
		WHERE Users.login='" . $login . "'";

	if (($array = mysqli_query($conn, $sql)) == NULL
		|| ($row = mysqli_fetch_assoc($array)) == NULL) {
			$ret = FALSE;
		} else {
			$ret = ($row['passwd'] == $passwd);
		}

	mysqli_close($conn);
	return ($ret);
}

?>
