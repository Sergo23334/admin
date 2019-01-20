<?php
	if(isset($_POST["clear"])){
		require_once("functions/config.php");

		connect();

		$result = mysqli_query($con, "TRUNCATE TABLE `".$_GET["table"]."`");

		mysqli_close($con);

		if($result){
			$result = "Выполнено успешно! (\"TRUNCATE TABLE `".$_GET["table"]."`\")";
		}else{
			$result = "Ошибка! (\"TRUNCATE TABLE `".$_GET["table"]."`\")";
		};
	};
?>