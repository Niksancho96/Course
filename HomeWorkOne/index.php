<?php
	
	$pageTitle = "Начало";
	
	include_once("includes/header.php");
	include_once("includes/variables.php");
	
	$finalSum = 0;
?>
	
	<center>
		<a href="drain.php">Нов разход</a>
		<form method="post">
			<select name="filter_type">
				<?php
					foreach ($variable as $key => $value) {
						echo "<option value=". $key .">" . $value . "</option>";
					}
				?>
			</select>
			<input type="submit" name="filter" value="Филтрирай" />
		</form>

	</center>
	
	<hr width="800" />
	
	<table border="1" align="center">
		<tr>
			<th>Дата</th>
			<th>Име</th>
			<th>Вид</th>
			<th>Сума</th>
		</tr>
		
		<?php
			if (isset($_POST['filter'])) {
				$selectedType = $_POST['filter_type'];
				include_once("includes/with.php");
			} else {
				include_once("includes/without.php");
			}
		?>
	</table>

<?php
	
	include_once("includes/footer.php");
?>