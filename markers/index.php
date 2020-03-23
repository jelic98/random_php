<?php
	$debug = false;

	ini_set("display_errors", $debug ? "on" : "off"); 

	class Marker {

		public $title, $lat, $lng;
	
		public function __construct($params) {
    		$this->title = $params[0];
    		$this->lat = floatval($params[1]);
    		$this->lng = floatval($params[2]);
  		}
	}

	$markers = [];

	$file = "markers.txt";

	if(file_exists($file)) {
		$file = fopen($file, "r");
	
		while(!feof($file)) {
			$line = fgets($file);
			$line = trim(preg_replace('/\s+/', ' ', $line));

			if(strlen($line) == 0) {
				continue;
			}

			$markers[] = new Marker(explode(", ", $line));
		}
	
		fclose($file);
	}
?>
<html>
	<head>
		<title>Zvanična AwCream stranica</title>
		<meta name="viewport" content="initial-scale=1.0">
    	<meta charset="utf-8">
	    <style>
      		html, body {
        		height: 100%;
      	 		margin: 0;
       	 		padding: 0;
      		}

      		#map {
        		height: 100%;
      		}
    	</style>
	</head>
	<body>
		<div id="map"></div>
    	<script>
      		var map;
			var center = {lat: 44.804295, lng: 20.453029};
     		
			function initMap() {
        		map = new google.maps.Map(document.getElementById('map'), {
          			center: center,
					zoom: 13
        		});
				
				<?php echo "var markers = JSON.parse('" . json_encode($markers) . "');"; ?>
				
				for(let i = 0; i < markers.length; i++) {
					var marker = new google.maps.Marker({
						title: markers[i].title,
						position: new google.maps.LatLng(markers[i].lat, markers[i].lng),
						map: map,
						animation: google.maps.Animation.DROP
					});
		
					marker.addListener('click', function() {
						alert(this.title);
					});
				}
      		}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>	
	</body>
</html>
