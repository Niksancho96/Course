<?php
	
	$pageTitle = "Нов разход";
	
	include_once("includes/header.php");
	
?>
	
	<center>
		<a href="index.php">Начало</a>
		
		<form method="post">
			
			<div>Име: </div>
			<input type="text" name="name" />
			
			<div>Сума: </div>
			<input type="text" name="price" />
			
			<div>Вид: </div>
			<select name="type">
				<?php
					include_once("includes/variables.php");
				
					foreach ($variable as $key => $value) {
						echo "<option value=". $key .">" . $value . "</option>";
					}
				?>
			</select>
			
			<input type="submit" name="save" value="Запиши" />
			
		</form>
		
	</center>
	
	<?php
		if (isset($_POST['save'])) {
			$name = trim($_POST['name']);
			$name = htmlspecialchars($_POST['name']);
			$name = str_replace("-", "", $name);
			
			$price = trim($_POST['price']);
			$price = htmlspecialchars($_POST['price']);
			$price = str_replace("-", "", $price);
			
			$type = (int)$_POST['type'];
			$type = str_replace("-", "", $type);
			
			$date = date("d.m.y");
			
			if (strlen($name) < 3) {
				$error = "Името е под 3 символа!";
			}
			
			if (is_numeric($price) == false) {
				$error = "Трябва да въведете число за цена!";
			}
			
			if ($price < 0) {
				$error = "Цената трябва да е по-голяма от 0!";
			}
			
			if (!array_key_exists($type, $variable)) {
				$error = "Невалиден тип!";
			}
			
			if (!$error) {
				$result = $date . '-' . $name . '-' . $type . '-' . $price . "\n";
				if(file_put_contents("record.txt", $result, FILE_APPEND)) {
					echo "Записа е успешен";
				} else {
					echo "Записа е не успешен!";
				}
			} else {
				echo $error;
			}
		}
	?>
	
<?php
	
	include_once("includes/footer.php");
?>