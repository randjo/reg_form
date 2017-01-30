<?php
include 'connect.php';
mysqli_set_charset($mysqli, 'utf8');

$user_id = 0;
$address_id = 0;

function sql_users(){
	global $mysqli, $user_id;
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$sql_users = "INSERT INTO users (user_fname, user_mname, user_lname, user_login, user_email, user_phone)
	VALUES ('$fname', '$mname', '$lname', '$uname', '$email', '$phone')";

	$mysqli->query($sql_users);
	$user_id = $mysqli->insert_id;
}

function sql_addresses(){
	global $mysqli, $address_id;
	$sql_addresses = "INSERT INTO addresses (address_line_1, address_line_2, address_zip, address_city, address_province, address_country)
	VALUES
	('". $_POST['addr1'] . "',
	'" . $_POST['addr2'] . "',
	'" . $_POST['pk'] . "',
	'" . $_POST['city'] . "',
	'" . $_POST['region'] . "',
	'" . $_POST['country'] . "')";

	$mysqli->query($sql_addresses);
	$address_id = $mysqli->insert_id;
}

function sql_additional_addresses(){
	global $mysqli, $address_id, $i;
	$sql_addresses = "INSERT INTO addresses (address_line_1, address_line_2, address_zip, address_city, address_province, address_country)
	VALUES
	('". $_POST['addr1_'.$i] . "',
	'" . $_POST['addr2_'.$i] . "',
	'" . $_POST['pk_'.$i] . "',
	'" . $_POST['city_'.$i] . "',
	'" . $_POST['region_'.$i] . "',
	'" . $_POST['country_'.$i] . "')";

	$mysqli->query($sql_addresses);
	$address_id = $mysqli->insert_id;
}

function sql_notes(){
	global $mysqli, $user_id;
	$sql_notes = "INSERT INTO notes (note_user_id, note_text)
	VALUES
	('". $user_id . "',
	'" . $_POST['note'] . "')";

	$mysqli->query($sql_notes);
}

function sql_additional_notes(){
	global $mysqli, $user_id, $j;
	$sql_notes = "INSERT INTO notes (note_user_id, note_text)
	VALUES
	('". $user_id . "',
	'" . $_POST['note_'.$j] . "')";

	$mysqli->query($sql_notes);
}

function sql_users_addresses(){
	global $mysqli, $user_id, $address_id;
	$sql_users_addresses = "INSERT INTO users_addresses (ua_user_id, ua_address_id)
	VALUES
	('". $user_id . "',
	'" . $address_id . "')";

	$mysqli->query($sql_users_addresses);
}

sql_users();
sql_addresses();
sql_notes();
sql_users_addresses();
$i = 1;
while(isset($_POST['addr1_'.$i])){
	sql_additional_addresses();
	sql_users_addresses();
	$i++;
};

$j = 1;
while(isset($_POST['note_'.$j])){
	sql_additional_notes();
	$j++;
};

$result_user = mysqli_query($mysqli, "SELECT * FROM users WHERE user_id = $user_id");
$row = mysqli_fetch_array($result_user);
?>

<table>
	<tr>
		<td width = 50%>Собствено име: </td><td width = 50%><?php echo $row['user_fname']; ?></td>
	</tr>
	<tr>
		<td>Бащино име: </td><td><?php echo $row['user_mname']; ?></td>
	</tr>
	<tr>
		<td>Фамилия: </td><td><?php echo $row['user_lname']; ?></td>
	</tr>
	<tr>
		<td>Потребителско име: </td><td><?php echo $row['user_login']; ?></td>
	</tr>
	<tr>
		<td>Електронна поща: </td><td><?php echo $row['user_email']; ?></td>
	</tr>
	<tr>
		<td>Телефон: </td><td><?php echo $row['user_phone']; ?></td>
	</tr>
</table>

<h2>Адреси</h2>
<hr width="80%" align="left" />

<?php

$result_addresses = mysqli_query($mysqli, "select address_line_1, address_line_2, address_zip,
	address_city, address_province, address_country
	from addresses,users_addresses where addresses.address_id = users_addresses.ua_address_id
	and users_addresses.ua_user_id = $user_id");

$ind = 0;$number = 1;
echo "<table width=80% cellpadding=10>";
while($row_addresses = mysqli_fetch_assoc($result_addresses)){
	if($ind % 2 == 0) echo "<tr>";
	echo "<td width=50%>";
	echo $number.". ";$number++;
	foreach ($row_addresses as $value) {
		echo $value."<br>";
	}
	echo "</td>";
	$ind++;
}
echo "</table>";

?>
<h2>Бележки</h2>
<hr width="80%" align="left" />

<?php
$result_notes = mysqli_query($mysqli, "SELECT note_text FROM notes WHERE note_user_id = $user_id");
while($row_notes = mysqli_fetch_assoc($result_notes)){
	echo "<p>";
		echo nl2br($row_notes['note_text']);
		echo "<hr width=60% align=left />";
	echo "</p>";
}
?>
