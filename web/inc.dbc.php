<?php
	function get_connection() {
    $arr = parse_ini_file ('../config.conf');
		$dsn = 'mysql:host=127.0.0.1;port=3306;dbname=project'; //Change dbname to yours
		$userid = 'root'; //Change this to yours
		$password = 'Matrix2xl1990@'; //Change this to yours

		try {
		    $db = new PDO($dsn, $userid, $password);
		}

		catch(PDOException $e) {
			echo $e->getMessage();
	  }
	  return $db;
	}
?>
