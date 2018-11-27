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
			$cmd = "SELECT username, password, type FROM users";
			$result = mysqli_query($connect, $cmd);

			echo "<table>";
			echo "<tr>";
			echo "<th>Username</th>";
			echo "<th>Password</th>";
			echo "<th>Type</th>";
			echo "</tr>";
		
			while($row = mysqli_fetch_array($result)) {
				$username = $row['username'];
				$password = $row['password'];
				$type = $row['type'];
				
				echo "<tr>";
				echo "<td>" . $username . "</td>";
				echo "<td>" . $password . "</td>";
				echo "<td>" . $type . "</td>";
				echo "</tr>";
			}
	
			echo "</table>";
		?>
	</body>
</html>
