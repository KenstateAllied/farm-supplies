<?php
	$host = getenv('PGHOST') ?: 'localhost';
	$port = getenv('PGPORT') ?: '5432';
	$database = getenv('PGDATABASE') ?: 'br';
	$username = getenv('PGUSER') ?: 'postgres';
	$password = getenv('PGPASSWORD') ?: 'mutsam';

	$dsn = "pgsql:host=$host;port=$port;dbname=$database";

	$pdo = new PDO($dsn, $username, $password, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
	]);
?>
