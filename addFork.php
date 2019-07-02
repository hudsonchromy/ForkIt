//server side php for the newFork file, takes the from from that file and makes a new fork



<?
	
	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, 'ForkIt') or die('Error: Unable to Connect');


	$restaurant = mysqli_real_escape_string($db, $_POST['restaurant']);
	$rating = mysqli_real_escape_string($db, $_POST['rating']);
	$durability = mysqli_real_escape_string($db, $_POST['durability']);
	$looks = mysqli_real_escape_string($db, $_POST['looks']);

	if (isset($_POST['submit'])) {
		$sqlAdd = "INSERT INTO Forks (restaurant, rating, durability, looks) VALUES ('$restaurant', '$rating', '$durability', '$looks')";
		echo $sqlAdd;
		mysqli_query($db, $sqlAdd);
	}
?>