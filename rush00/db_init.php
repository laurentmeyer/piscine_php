<?php

	function db_destroy_db() {
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$sql = "DROP DATABASE IF EXISTS " . "rushDB";
	if (mysqli_query($conn, $sql)) {
		echo "Database destroyed successfully\n";
	} else {
		echo "Error destroying database: " . mysqli_error($conn) . "\n";
	}

	mysqli_close($conn);
	}

function db_init() {
	$conn = mysqli_connect("localhost", "username", "password");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$sql = "CREATE DATABASE " . "rushDB";
	if (mysqli_query($conn, $sql)) {
		echo "Database created successfully\n";
	} else {
		echo "Error creating database: " . mysqli_error($conn) . "\n";
	}

	if (!mysqli_set_charset($conn, "utf8")) {
		printf("Error loading character set utf8: %s\n", mysqli_error($conn));
		exit();
	} else {
		printf("Current character set: %s\n", mysqli_character_set_name($conn));
	}

	mysqli_close($conn);
}

function db_create_tables() {
	$conn = mysqli_connect("localhost", "username", "password", "rushDB");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error()) . "\n";
	}

	$sql = "DROP TABLE IF EXISTS Users";
	if (mysqli_query($conn, $sql)) {
		echo "Table Userss droppeded successfully\n";
	} else {
		echo "Error dropping table: " . mysqli_error($conn) . "\n";
	}

	$sql = "CREATE TABLE Users (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		login VARCHAR(30) NOT NULL,
		passwd VARCHAR(130) NOT NULL,
		admin BOOLEAN,
		UNIQUE (login)
)";
	if (mysqli_query($conn, $sql)) {
		echo "Table Products created successfully\n";
	} else {
		echo "Error creating table: " . mysqli_error($conn) . "\n";
	}

	$sql = "DROP TABLE IF EXISTS Products";
	if (mysqli_query($conn, $sql)) {
		echo "Table Products droppeded successfully\n";
	} else {
		echo "Error dropping table: " . mysqli_error($conn) . "\n";
	}

	$sql = "CREATE TABLE Products (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		name VARCHAR(30) NOT NULL,
		img_path VARCHAR(500),
		description VARCHAR(200) NOT NULL,
	price DECIMAL(10,2) NOT NULL
)";
	if (mysqli_query($conn, $sql)) {
		echo "Table Products created successfully\n";
	} else {
		echo "Error creating table: " . mysqli_error($conn) . "\n";
	}

	$sql = "DROP TABLE IF EXISTS Categories";
	if (mysqli_query($conn, $sql)) {
		echo "Table Categories droppeded successfully\n";
	} else {
		echo "Error dropping table: " . mysqli_error($conn) . "\n";
	}

	$sql = "CREATE TABLE Categories (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		name VARCHAR(30) NOT NULL
	)";
	if (mysqli_query($conn, $sql)) {
		echo "Table Categories created successfully\n";
	} else {
		echo "Error creating table: " . mysqli_error($conn) . "\n";
	}

	$sql = "DROP TABLE IF EXISTS Categories_Products";
	if (mysqli_query($conn, $sql)) {
		echo "Table Categories_Products droppeded successfully\n";
	} else {
		echo "Error dropping table: " . mysqli_error($conn) . "\n";
	}

	$sql = "CREATE TABLE Categories_Products (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		c_id INT NOT NULL,
		p_id INT NOT NULL
	)";
	if (mysqli_query($conn, $sql)) {
		echo "Table Categories_Products created successfully\n";
	} else {
		echo "Error creating table: " . mysqli_error($conn) . "\n";
	}


	mysqli_close($conn);
}
