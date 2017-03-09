<?php

	function get_connection() {
		$dsn = 'mysql:host=cssgate.insttech.washington.edu;dbname=tmw26'; //Change dbname to yours
		$userid = 'tmw26'; //Change this to yours
		$password = 'Nomaktor'; //Change this to yours

		try {
		    $db = new PDO($dsn, $userid, $password);
		}
		catch(PDOException $e) {
			echo "Error connecting to database";
	    }
	    return $db;
	}
?>