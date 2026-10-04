<?php
	session_start();
	include 'dbconf.php';
	if (!isset($_SESSION['login']))
		header('Location: login-ui.php');
	
	date_default_timezone_set('Asia/Jakarta');
	
	$result = $pdo->prepare("UPDATE mobil SET keluar = ?, status = 'keluar' WHERE id_mobil = ?");
	$result->execute([date('Y-m-d H:i:s'), (int) $_GET['id']]);
							
	header('Location: keluar.php');
?>