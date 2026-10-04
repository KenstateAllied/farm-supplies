<?php
	session_start();
	include 'dbconf.php';
	if (!isset($_SESSION['login']))
		header('Location: login-ui.php');
	
	date_default_timezone_set('Asia/Jakarta');
	
	$spe = $_POST['spe'];
	
	$result = $pdo->prepare("UPDATE mobil SET spe = ?, muat = ?, status = 'proses muat' WHERE id_mobil = ?");
	$result->execute([$spe, date('Y-m-d H:i:s'), (int) $_GET['id']]);
							
	header('Location: muat.php');
?>