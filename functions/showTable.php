<?php
	if(isset($_GET["table"])){
		require_once("functions/config.php");

		$tablename = $_GET["table"];

		if(empty($_GET["page"]) || $_GET["page"] < 1) $_GET["page"] = 1;
		
		$limit = 25;

		connect();

		$columns = mysqli_query($con, "SHOW COLUMNS FROM `$tablename`");

		$head = array();

		for($i = 0; $i < mysqli_num_rows($columns); $i++){
			$head[] = mysqli_fetch_row($columns);
			$head[$i] = $head[$i][0];
		};		

		if(empty($_POST["search"])){
			$sql = mysqli_query($con, "SELECT * FROM `$tablename` ORDER BY `id` DESC LIMIT ".($_GET["page"] - 1) * $limit.", $limit");
		}else{
			$query = "SELECT * FROM `$tablename` WHERE ";

			for($i = 0; $i < count($head); $i++){
				
				$query = $query."`".$head[$i]."`"." LIKE '".$_POST["search"]."'";
				
				if($i + 1 < count($head)){
					$query = $query." OR ";
				}
			};

			$query = $query." ORDER BY `id` DESC";

			$sql = mysqli_query($con, "$query");
		};

		mysqli_close($con);

		$table = array();

		for($i = 0; $i < mysqli_num_rows($sql); $i++){
			$table[] = mysqli_fetch_row($sql);
		};
	};
?>