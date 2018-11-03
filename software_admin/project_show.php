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
			$cmd = "SELECT * FROM projects";
			$result = mysqli_query($connect, $cmd);

			echo "<table>";
			echo "<tr>";
			echo "<th>Project name</th>";
			echo "<th>API key</th>";
			echo "</tr>";
		
			while($row = mysqli_fetch_array($result)) {
				$name = $row['name'];
				$key = $row['api_key'];
				
				echo "<tr>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $key . "</td>";
				echo "</tr>";
			}
	
			echo "</table>";
		?>
	</body>
</html>
