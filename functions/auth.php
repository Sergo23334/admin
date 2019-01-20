<?php
	if(isset($_POST["signin"])){
		$log = $_POST["log"];
		$pass = $_POST["pass"];

		if($log != "admin" || $pass != ""){
			$error = "Не верно указаны данные"; 
			return;
		};

		session_start();
		$_SESSION["admin"] = true;
		header("location: crud.php");
	};

	if(isset($_POST["exit"])){
		session_unset();
		header("location: index.php");
	};
?>