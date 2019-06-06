<?php
	function init_database($servername, $username, $password, $dbname)
	{
	$conn = mysqli_connect($servername, $username, $password);
	if (!$conn)
		die("Connection failed: ".mysqli_connect_error());
	$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
	if (!mysqli_query($conn, $sql)) 
		die("Error creating database: ".mysqli_error($conn));
	mysqli_close($conn);
	init_users($servername, $username, $password, $dbname);
	init_products($servername, $username, $password, $dbname);
	init_orders($servername, $username, $password, $dbname);
	}
	function init_users($servername, $username, $password, $dbname)
	{
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn)
			die("Connection failed: ".mysqli_connect_error());
		$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
			login VARCHAR(255) NOT NULL,
			password VARCHAR(255) NOT NULL,
			admin_rights BOOLEAN NOT NULL,
			email VARCHAR(255) DEFAULT NULL,
			name VARCHAR(255) DEFAULT NULL,
			phone_number VARCHAR(255) DEFAULT NULL,
			address VARCHAR(255) DEFAULT NULL
			)";
		if (!mysqli_query($conn, $sql))
			die("Error creating users: ".mysqli_error($conn));
		$admin_pass = hash('whirlpool', 'admin');
		$sql = "INSERT INTO users (id, login, password, admin_rights)
				VALUES (1, 'admin', '".$admin_pass."', true)";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
	}
