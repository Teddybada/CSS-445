<?php

	function get_connection() {
    $arr = parse_ini_file ('config.conf');
		$dsn = 'mysql:host=cssgate.insttech.washington.edu;dbname=' . $arr[dbname]; //Change dbname to yours
		$userid = $arr[userid]; //Change this to yours
		$password = $arr[password]; //Change this to yours

		try {
		    $db = new PDO($dsn, $userid, $password);
		}

		catch(PDOException $e) {
			echo $e->getMessage();
	  }
	  return $db;
	}
?>
