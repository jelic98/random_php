<?php
	$query = $_GET['query'];
	$dir = $_GET['dir'];

	if(!isset($query) || !isset($dir)) {
		echo 'failed';
		exit;	
	}
	
	include('simple_html_dom.php');
		
	$query = urlencode($query);
	
	$html = file_get_html('https://www.google.com/search?q=' . $query . '&tbm=isch');
	
	$images = $html->find('img');

	mkdir($dir, 0777, true);

	for($i = 1; $i < sizeof($images); $i++) {
		$url = $images[$i]->src;
		
		$content = file_get_contents($url);

		$fp = fopen($dir . "/" . $i . ".jpg", "w");
		fwrite($fp, $content);
		fclose($fp);
	}

	echo 'success';
?>
