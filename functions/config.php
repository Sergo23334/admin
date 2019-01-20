<?php
	function connect(){
		$host = "";
		$user = "";
		$pass = "";
		$db = "";

		global $con;

		$con = mysqli_connect($host, $user, $pass, $db);

		mysqli_set_charset($con, "utf8");
	};
?>