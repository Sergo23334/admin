<?php
	require_once("functions/config.php");

	connect();

	$sql = mysqli_query($con, "SHOW TABLES");

	mysqli_close($con);

	$table_list = array();

	for($i = 0; $i < mysqli_num_rows($sql); $i++){
		$table_list[] = mysqli_fetch_array($sql);
	};
?>