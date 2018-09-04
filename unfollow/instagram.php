<?php
// PLEASE EDIT THESE VARIABLES !!!
$USERNAME = "sample_username";
$PASSWORD = "sample_password";
$CACHE_PATH = "/sample/cache/dir"; // must be absolute path
$FOLLOWERS_COUNT = 400; // total followers to extract
$FOLLOWERS_ROUND = 100; // total followers to extract in one request (must be lower than FOLLOWERS_COUNT)
$FOLLOWING_COUNT = 10; // total following users to extract
$FOLLOWING_ROUND = 10; // total following users to extract in one request (must be lower than FOLLOWING_COUNT)
// DO NOT EDIT ANYTHING BELOW THIS LINE !!!
// ...it just works ;)
?>
<html>
	<head>
		<title>Please wait...</title>
	</head>
	<body>
		<script>
			function openWindows() {
				<?php
					require("vendor/autoload.php");

					$index = 0;
	
					$followers = [];
					$following = [];
			
					$instagram = \InstagramScraper\Instagram::withCredentials(
						$USERNAME,
						$PASSWORD,
						$CACHE_PATH);
					$instagram->login();
					sleep(2);

					$account = $instagram->getAccount($USERNAME);
					sleep(1);

					$followers = $instagram->getFollowers($account->getId(), $FOLLOWERS_COUNT, $FOLLOWERS_ROUND, true);
					sleep(2);
	
					$followings = $instagram->getFollowing($account->getId(), $FOLLOWING_COUNT, $FOLLOWING_ROUND, true);

					foreach($followings as $following) {
						$found = false;

						foreach($followers as $follower) {
							if(strcmp($follower['username'], $following['username']) == 0) {
								$found = true;
								break;
							}
						}

						if(!$found) {
							echo 'console.log("' . ++$index . '. ' . $following['username'] . '");';
							echo 'window.open("https://www.instagram.com/' . $following['username'] . '", "mywindow' . $index . '", "width=500,height=500");';
						}
					}
				?>
			}
		</script>
		<a href="javascript: openWindows()">View unfollowers</a>
		<p>This link opens each unfollower's profile in new window. You can also see unfollower list in console.</p>
	</body>
</html>
