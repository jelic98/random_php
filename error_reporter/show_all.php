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
			$cmd = "SELECT reports.id AS id,
				reports.project AS project,
				reports.message AS message,
				reports.resolved AS resolved
				FROM reports
				INNER JOIN projects
				ON reports.project=projects.id";
			$result = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

			echo "<table>";
			echo "<tr>";
			echo "<th>Project</th>";
			echo "<th>Message</th>";
			echo "<th>Resolved</th>";
			echo "</tr>";
		
			while($row = mysqli_fetch_array($result)) {
				$reportId = $row['id'];
				$project = $row['project'];
				$message = $row['message'];
				$resolved = $row['resolved'];
		
				echo "<tr>";
				echo "<td>" . $project . "</td>";
				echo "<td>" . $message . "</td>";
				echo "<td>" . ($resolved == 1 ? "YES" : "NO") . "</td>";

				if($resolved != 1) {
					echo '<td><a href="resolve.php?id='. $reportId . '">Resolve</a></td>';
				}
				
				echo "</tr>";
			}
	
			echo "</table>";
		?>
	</body>
</html>
