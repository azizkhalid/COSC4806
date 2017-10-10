<?php
	function db_connect() {
		try {
			$host = 'localhost';
			$db   = 'cosc';
			$user = 'root';
			$pass = '';
			$charset = 'utf8';

			$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

			$dbh = new PDO($dsn, $user, $pass);
			//echo "Connected!"."<br/>";
			return $dbh;
		} catch (PDOException $e) {

			echo 'Connection failed: ' . $e->getMessage()."<br/>";
		}
	}
?>
