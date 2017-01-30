<?php
//connect to MySQL
//$mysqli = new mysqli("localhost","root","randjo85", "phplab_course_project") or die (mysqli_connect_error());
	$servername = "localhost";
	$username = "root";
	$password = "randjo85";
	$dbname = "phplab_course_project";

	$mysqli = new mysqli($servername, $username, $password, $dbname);
	if ($mysqli->connect_error) {
		die("Connection error: " . $mysqli->connect_error);
	}

	/*$sql = "Create table users (
		user_id int(6) unsigned auto_increment primary key,
		user_fname varchar(30) not null,
		user_mname varchar(30),
		user_lname varchar(30) not null,
		user_login varchar(4) not null,
		user_email varchar(30) not null,
		user_phone varchar(30)
	)";*/
	
	/*$sql = "Create table addresses (
		address_id int(6) unsigned auto_increment primary key,
		address_line_1 varchar(30) not null,
		address_line_2 varchar(30),
		address_zip varchar(4) not null,
		address_city varchar(30) not null,
		address_province varchar(30) not null,
		address_country varchar(30)
	)";*/

	/*$sql = "Create table notes (
		note_user_id int(6) not null,
		note_text varchar(30) not null
	)";*/

	/*$sql = "Create table users_addresses (
		ua_user_id int(6) not null,
		ua_address_id varchar(30) not null
	)";

	if ($mysqli->query($sql)) {
		echo "Table created successfuly!";
	}*/
?>