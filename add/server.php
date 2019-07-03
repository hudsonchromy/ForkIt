<?
    session_start();

	if (!isset($_SESSION['username'])) {
		header("location: ../");
	}
	if (isset($_POST['submit'])) {
		$HOST = getenv('host');
		$USERNAME = getenv('username');
		$PASSWORD = getenv('password');
		$DBNAME = getenv('dbname');
		$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DBNAME, 3306) or die('Error: Unable to Connect');


		$restaurant = mysqli_real_escape_string($db, $_POST['restaurant']);
		$rating = mysqli_real_escape_string($db, $_POST['rating']);
		$durability = mysqli_real_escape_string($db, $_POST['durability']);
		$looks = mysqli_real_escape_string($db, $_POST['looks']);
		$reviewText = mysqli_real_escape_string($db, $_POST['reviewText']);
		$findRestaurant = "SELECT * FROM Forks WHERE restaurant='$restaurant'";
		$restaurantId = mysqli_query($db, $findRestaurant);

		$user = $_SESSION['username'];

		$userQuery = "SELECT * FROM Users WHERE username='$user'";
		$userId = mysqli_fetch_assoc(mysqli_query($db, $userQuery))["id"];

		if (mysqli_num_rows($restaurantId) == 0) {
			$sqlAdd = "INSERT INTO Forks (restaurant, rating, durability, looks) VALUES ('$restaurant', '$rating', '$durability', '$looks')";
			mysqli_query($db, $sqlAdd);
		}
		$restaurantId = mysqli_fetch_assoc($restaurantId);
		$restaurantId = $restaurantId["id"];

		$sqlAdd = "INSERT INTO Reviews (restaurantId, rating, durability, looks, reviewText, userId) VALUES ('$restaurantId', '$rating', '$durability', '$looks', '$reviewText', '$userId')";
		$newData = mysqli_query($db, $sqlAdd);

		$reviewId = mysqli_insert_id($db);
		$file = $_FILES["fileToUpload"]['tmp_name'];
		if ($file) {
			include('upload.php');
		}
	}
?>