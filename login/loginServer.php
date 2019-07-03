<?php
	session_start();
	$username = "";
	$email = "";
	$errors = array();
	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$DBNAME = getenv('dbname');
	$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DBNAME, 3306) or die('Error: Unable to Connect');
	echo isset($_POST['submit']);
	if (isset($_POST['submit'])) {
		echo "string";
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		if (empty($username)) {
			array_push($errors, "Username is Required");
		};
		if (empty($password)) { array_push($errors, "Password is Required"); };

		$password = md5($password);
		$userCheck = "SELECT * FROM Users WHERE username='$username' AND password='$password'";
		$result = mysqli_query($db, $userCheck) or die("cannot search");
		$user = mysqli_fetch_assoc($result);
		if (!$user) {
			array_push($errors, "Username/Password is incorrect");
		}

		if(count($errors) == 0) {
			$_SESSION['username'] = $username;
			$_SESSION['userId'] = $user['id'];
			header('location: index.php');
		}

	}
?>