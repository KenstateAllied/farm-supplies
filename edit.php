<?php
	session_start();
	include 'dbconf.php';
	if (!isset($_SESSION['login']))
		header('Location: login-ui.php');
	
	date_default_timezone_set('Asia/Jakarta');
	
	$ekspedisi = $_POST['ekspedisi'];
	$jenis = $_POST['jenis'];
	$nopol = $_POST['nopol'];
	$supir = $_POST['supir'];
	$hp = $_POST['hp'];
	$tujuan = $_POST['tujuan'];
	
	$result = $pdo->prepare('UPDATE mobil SET ekspedisi = ?, jenis = ?, nopol = ?, supir = ?, hp = ?, tujuan = ? WHERE id_mobil = ?');
	$result->execute([$ekspedisi, $jenis, $nopol, $supir, $hp, $tujuan, (int) $_GET['id']]);
							
	header('Location: mobil.php');
?>