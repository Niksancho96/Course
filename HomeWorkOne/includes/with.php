<?php
	if (file_exists("record.txt")) {
		$fetch = file("record.txt");
		
		foreach ($fetch as $value) {
			$col = explode("-", $value);

			if ($col[2] == $selectedType) {
			$finalSum += $col[3];
?>
				<tr>
					<td><?php echo $col[0]; ?></td>
					<td><?php echo $col[1]; ?></td>
					<td><?php echo $variable[trim($col[2])]; ?></td>
					<td><?php echo $col[3]; ?></td>
				</tr>
<?php
			} else if ($selectedType == 6) {
				header("Location:index.php");
			}
		}
	}
?>
		<tr>
			<td>----</td>
			<td>----</td>
			<td>----</td>
			<td><?php echo $finalSum; ?></td>
		</tr>