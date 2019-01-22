<?php
	session_start();
	if(empty($_SESSION["admin"])){
		header("location: index.php");
	};
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>Admin</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<?php
			require_once("functions/upload.php");
			require_once("functions/clear.php");
			require_once("functions/delete.php");
			require_once("functions/tablelist.php");
			require_once("functions/auth.php");
			require_once("functions/insert.php");
			require_once("functions/showTable.php");
		?>
	</head>

	<body>
		<div id="choiceTable">
			<h1 align="center">Выбирите таблицу</h1>
			<?php
				echo "<ul>";
				for($i = 0; $i < count($table_list); $i++)
					echo "<li><a href=?table=".$table_list[$i]["0"].">".$table_list[$i]["0"]."</a></li>";
				echo "</ul>";
			?>

			<?php if(isset($_GET["table"])){ ?>
				</br><form action="" method="POST"><input <?php if(isset($_POST["search"])) echo "value=".$_POST["search"]; ?> placeholder="Поиск по таблице" name="search" type="search"><input type="submit" value="Найти"></form>
				</br><form method="POST"><input name="clear" value="Очистить таблицу" type="submit"></form>
			<?php }; ?>

			<form action="" method="POST" enctype="multipart/form-data">
				<input placeholder="Относительный путь" type="text" name="puth">
				<input type="file" name="image"></br>
				<input type="submit">
			</form>

			</br><form method="POST"><input value="Выйти" name="exit" type="submit"></form>

		</div>

		<?php if(isset($_GET["table"])){ ?>
			<div id="table">
				<?php if(isset($result)){ ?><script> $(document).ready(function(){ alert("<?= addslashes($result) ?>"); }); </script><?php }; ?>

				<h1>Добавить запись</h1>

				<form method="POST">
					<?php
						for($i = 1; $i < count($head); $i++){
							if(empty($_POST[$head[$i]])){
								echo "<div style='float: left;'><span>".$head[$i]."</span></br><textarea name='".$head[$i]."' placeholder='".$head[$i]."'></textarea></div>";
							}else{
								echo "<div style='float: left;'><span>".$head[$i]."</span></br><textarea name='".$head[$i]."' placeholder='".$head[$i]."'>".$_POST[$head[$i]]."</textarea></div>";
							};
						};
					?>

					<div  style="clear: both;"></div>
					<input name="insert" value="Сохранить запись" type="submit">
				</form>

				<h1>Изменить таблицу</h1>

				<?php if(empty($_POST["search"])){ ?>
					<div align="center"><a href="<?= '?table='.$_GET['table'] ?>&page=<?= $_GET['page'] - 1 ?>">Назад</a> | <a href="<?= '?table='.$_GET['table'] ?>&page=<?= $_GET['page'] + 1 ?>">Вперед</a></div>
				<?php }; ?>

				<table border="2">
					<tr id="tableHead">
						<td></td><td></td>
						<?php
							for($i = 0; $i < count($head); $i++){
								echo "<td bgcolor='red'>".$head[$i]."</td>";
							};
						?>
					</tr>

					<?php
						foreach($table as $key => $string){
							echo "<form method='POST'><tr><td><button value='".$string[0]."' type='submit' name='delete'>Удалить</button></td></form><form id='".$string[0]."'><td><button class='update' id='".$string[0]."' type='button'>Изменить</button></td>";

							for($i = 0; $i < count($string); $i++){
								if($i > 0){
									echo "<td><textarea name='".$head[$i]."'>".$string[$i]."</textarea></td>";
								}else{
									echo "<td>".$string[$i]."</td>";
								};
							};
								echo "</tr></form>";
							};
						?>
					</form>
				</table>
			</div>
		<?php }; ?>

		<script>
			$(document).ready(function(){
				$(".update").on("click", function(){
					var data = $("#" + $(this).attr("id")).serialize();
					
					$.ajax({
						url: "functions/update.php",
						type: "POST",
						dataType: "html",
						data: (data + "&id=" + $(this).attr("id") + "&table=" + "<?= $_GET['table'] ?>"),
						success: success
					});
				});

				function success(data){
					alert(data);
				};
			});
		</script>
	</body>
</html>

