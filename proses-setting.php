<?php
	session_start();
	include 'dbconf.php';
	include 'lhast.php'; 
	if (!isset($_SESSION['login']))
		header('Location: login-ui.php');
	
	date_default_timezone_set('Asia/Jakarta');
	
	$judul = $_POST['judul'];
	$desc = $_POST['desc'];
	$creator = $_POST['creator'];
	
	$uploaddir = 'uploads/slider/';
	$uploadfile1 = $uploaddir . basename($_FILES['slider1']['name']);
	move_uploaded_file($_FILES['slider1']['tmp_name'], $uploadfile1);
	$uploadfile2 = $uploaddir . basename($_FILES['slider2']['name']);
	move_uploaded_file($_FILES['slider2']['tmp_name'], $uploadfile2);
	$uploadfile3 = $uploaddir . basename($_FILES['slider3']['name']);
	move_uploaded_file($_FILES['slider3']['tmp_name'], $uploadfile3);
	
	$result = $pdo->prepare('UPDATE setting SET creator = ?, judul = ?, "desc" = ?, slider1 = ?, slider2 = ?, slider3 = ? WHERE id_setting = 1');
	$result->execute([
		$creator,
		$judul,
		$desc,
		$_FILES['slider1']['name'],
		$_FILES['slider2']['name'],
		$_FILES['slider3']['name'],
	]);
							
	header('Location: setting.php');
?>