<?php
	require_once("config.php");

	connect();

	$sql = mysqli_query($con, "SHOW COLUMNS FROM ".$_POST["table"]);

	$var = array();

	for($i = 0; $i < mysqli_num_rows($sql); $i++){
		$var[] = mysqli_fetch_row($sql); 
		$var[$i] = $var[$i][0];
	};

	foreach($_POST as $value[]);

	$query = "UPDATE `".$_POST["table"]."` SET ";

	for($i = 0; $i < count($value); $i++){
		if($i + 2 < count($value)){
			$query = $query."`".$var[$i + 1]."`"." = '".$value[$i]."'";

			if($i + 3 < count($value)){
				$query = $query.", ";
			};
		};
	};

	$query = $query." WHERE `id` = ".$_POST["id"];

	$result = mysqli_query($con, "$query");

	mysqli_close($con);

	if(!$result){
		echo "Ошибка перезаписи! (\"".$query."\")";
	}else{
		echo "Выполнено успешно! (\"".$query."\")";
	};
?>
