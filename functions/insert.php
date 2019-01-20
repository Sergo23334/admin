<?php
	require_once("functions/config.php");

	if(isset($_POST["insert"])){
		connect();
		$sql = mysqli_query($con, "SHOW COLUMNS FROM ".$_GET["table"]);

		$var = array();

		for($i = 0; $i < mysqli_num_rows($sql); $i++){
			$var[] = mysqli_fetch_row($sql); 
			$var[$i] = $var[$i][0];
		};

		$query = "INSERT INTO `".$_GET["table"]."` (";

		for($i = 1; $i < count($var); $i++){
			$query = $query."`".$var[$i]."`";

			if($i + 1 < count($var)){
				$query = $query.", ";
			};
		};

		$query = $query.") VALUE (";

		$value = array();

		foreach($_POST as $value[]);

		for($i = 0; $i < count($value); $i++){
			if($value[$i] != end($value)){
				$query = $query."'".addslashes($value[$i])."'";
			};

			if($i + 2 < count($value)){
				$query = $query.", ";
			};
		};

		$query = $query.")";

		$result = mysqli_query($con, "$query");

		if(!$result){
			$result = "Ошибка запоса \"".stripslashes(htmlspecialchars($query))."\"!";
		}else{
			header("location: $_SERVER[REQUEST_URI]");
		};

		mysqli_close($con);
	};
?>