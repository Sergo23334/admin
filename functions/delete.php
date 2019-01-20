<?php
	if(isset($_POST["delete"])){
		require_once("functions/config.php");

		connect();
			$result = mysqli_query($con, "DELETE FROM `".$_GET["table"]."` WHERE `id` = '".$_POST["delete"]."'");
		mysqli_close($con);

		if($result){
			$result = "Выполнено успешно! (\"DELETE FROM `".$_GET["table"]."` WHERE `id` = '".$_POST["delete"]."'\")";
		}else{
			$result = "Ошибка! (\"DELETE FROM `".$_GET["table"]."` WHERE `id` = '".$_POST["delete"]."'\")";
		};
	};
?>