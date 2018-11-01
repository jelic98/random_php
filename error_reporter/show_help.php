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
			$cmd = "SELECT email, message FROM contact";
			$result = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

			echo "<table>";
			echo "<tr>";
			echo "<th>Email</th>";
			echo "<th>Message</th>";
			echo "</tr>";
		
			while($row = mysqli_fetch_array($result)) {
				$project = $row['email'];
				$message = $row['message'];
				
				echo "<tr>";
				echo "<td>" . $project . "</td>";
				echo "<td>" . $message . "</td>";
				echo "</tr>";
			}
	
			echo "</table>";
		?>
	</body>
</html>
