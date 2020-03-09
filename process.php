<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud_alpin') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nik = '';
$name = '';
$location = '';
$religion = '';
$gender = '';

if(isset($_POST['save'])){
	$nik = $_POST['nik'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	$religion = $_POST['religion'];
	$gender = $_POST['gender'];

	$mysqli->query("INSERT INTO data (nik, name, location, religion, gender) VALUES('$nik', '$name', '$location', '$religion', '$gender')") or die($mysqli->error);

	$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";

	header("location: index.php");
}

if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");
}

if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
	if($result->num_rows){
		$row = $result->fetch_array();
		$nik = $row['nik'];
		$name = $row['name'];
		$location = $row['location'];
		$religion = $row['religion'];
		$gender = $row['gender'];
	}
}

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$nik = $_POST['nik'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	$religion = $_POST['religion'];
	$gender = $_POST['gender'];

	$mysqli->query("UPDATE data SET nik='$nik', name='$name', location='$location', religion='$religion', gender='$gender' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been updated!";
	$_SESSION['msg_type'] = "warning";

	header("location: index.php");
}


?>