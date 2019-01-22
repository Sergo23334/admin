<?php
	if(isset($_FILES["image"])){
		$puth = $_POST["puth"];
		$file_name = $_FILES["image"]["name"];
		$file_tmp = $_FILES["image"]["tmp_name"];

		$upload = move_uploaded_file($file_tmp, $puth.$file_name);

		if($upload){
			$result = "Выполнено успешно!";
		}else{
			$result = "Ошибка загрузки!";
		};
	};
?>