<!-- //server side php for the addReview file, takes the from from that file and makes a new fork
 -->
<?
	
	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, 'ForkIt') or die('Error: Unable to Connect');


	$restaurant = mysqli_real_escape_string($db, $_POST['restaurantId']);
	$rating = mysqli_real_escape_string($db, $_POST['rating']);
	$durability = mysqli_real_escape_string($db, $_POST['durability']);
	$looks = mysqli_real_escape_string($db, $_POST['looks']);
	$userId = mysqli_real_escape_string($db, $_POST['userId']);
	$reviewText = mysqli_real_escape_string($db, $_POST['reviewText']);

	if (isset($_POST['submit'])) {
		$sqlAdd = "INSERT INTO Reviews (restaurantId, rating, durability, looks, reviewText, userId) VALUES ('$restaurant', '$rating', '$durability', '$looks', '$reviewText', '$userId')";
		echo $sqlAdd;
		mysqli_query($db, $sqlAdd);
	}
?>