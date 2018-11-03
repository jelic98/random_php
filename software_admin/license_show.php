<?php require("autoload.php"); ?>
<html>
	<head>
		<style>
			table,
			th,
			td {
   				border: 1px solid black;
			}
		</style>
	</head>
	<body>
		<?php
			$cmd = "SELECT * FROM licenses";
			$result = mysqli_query($connect, $cmd);

			echo "<table>";
			echo "<tr>";
			echo "<th>Full name</th>";
			echo "<th>Code</th>";
			echo "<th>Activated</th>";
			echo "</tr>";
		
			while($row = mysqli_fetch_array($result)) {
				$name = $row['name'];
				$code = $row['code'];
				$activated = $row['activated'];
				
				echo "<tr>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $code . "</td>";
				echo "<td>" . ($activated == 1 ? "YES" : "NO") . "</td>";
				echo "</tr>";
			}
	
			echo "</table>";
		?>
	</body>
</html>
