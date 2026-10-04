<?php
	session_start();
	include 'dbconf.php';
	include 'lhast.php'; 
	if (!isset($_SESSION['login']))
		header('Location: login-ui.php');
	
	$result = $pdo->prepare('DELETE FROM "user" WHERE id = ?');
	$result->execute([(int) $_GET['id']]);
	header('Location: user.php');
?>