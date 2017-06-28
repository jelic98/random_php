<?php
	require_once 'vendor/autoload.php';
	use Goutte\CLient;

	define("DIR", $_GET['dir']);

	function getName() {
	   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	   $charactersLength = strlen($characters);
	   $randomString = '';
	   
	   for ($i = 0; $i < 10; $i++) {
	       $randomString .= $characters[rand(0, $charactersLength - 1)];
	   }

		$dir = DIR;

	   if(!file_exists($dir)) {
          mkdir($dir, 0777, true);
	   }

	   $filename = $dir . "/" . $randomString . ".jpg";

	   if(file_exists($filename)) {
			return getName($dir);
	   }

	   return $filename;
	}

	function scrap($crawler, $client, $i) {
		if($i > 10) {
			return;	
		}

		$crawler->filter('img')->each(function ($node) {
		$url = $node->attr('src');

		if(strpos($url, 'http') === false) {
			return;
		}

		$content = file_get_contents($url);

		$fp = fopen(getName(), "w");
		fwrite($fp, $content);
		fclose($fp);
		});

		$crawler = $client->click($crawler->selectLink('Следећа')->link());

		$i++;

		scrap($crawler, $client, $i);
	}

	$query = $_GET['query'];

	$query = urlencode($query);
		
	$client = new Client();

	$crawler = $client->request('GET', 'https://www.google.com/search?q=' . $query . '&tbm=isch');

	scrap($crawler, $client, 0);

	echo 'success' . '<br/>';
	echo '<a href="index.html">Again</a>'
?>
