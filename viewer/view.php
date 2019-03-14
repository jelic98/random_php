<?php
	if(!isset($_GET['q'])) {
		echo '400 Bad Request';
		exit;
	}

	$query = $_GET['q'];
	
	require("pages.php");

	if(!array_key_exists($query, $pages)) {
		echo '404 Not Found';
		exit;
	}

	$pagename = $pages[$query];

	header("Location: " . $_SERVER['HTTP_REFERER']);
?>
<script type="text/javascript">
	window.open('<?php echo $pagename; ?>', '_blank');
</script>
