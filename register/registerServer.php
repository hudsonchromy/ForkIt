<?php
	
	$username = "";
	$email = "";
	$errors = array();

	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$DBNAME = getenv('dbname');
	$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DBNAME, 3306) or die('Error: Unable to Connect');

	if (isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password1 = mysqli_real_escape_string($db, $_POST['password1']);
		$password2 = mysqli_real_escape_string($db, $_POST['password2']);
		if (empty($username)) {
			array_push($errors, "Username is Required");
		};
		if (empty($email)) { array_push($errors, "Email is Required"); };

		if (empty($password1)) { array_push($errors, "Password is Required"); };

		if ($password1 != $password2) { array_push($errors, "Passwords do not match"); };

		$userCheck = "SELECT * FROM Users WHERE username='$usename' OR email='$email' LIMIT 1";
		$result = mysqli_query($db, $userCheck);
		$user = mysqli_fetch_assoc($result);

		if ($user) {
			if ($user['username'] === $username) {
		      array_push($errors, "Username already exists");
		    }

		    if ($user['email'] === $email) {
		      array_push($errors, "email already exists");
		    }
		}

		if(count($errors) == 0) {
			$password = md5($password1);
			$addQuery = "INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$password')";
			echo $addQuery;
			mysqli_query($db, $addQuery) or die("Couldnt add");
		}

	}
?>

