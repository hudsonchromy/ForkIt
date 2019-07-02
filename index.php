<?php
	session_start();
	if (isset($_SESSION["username"])) {
		include('./topnav.php');
	}
	else {
		include('./anontopnav.php');
	}
?>
<HTML>
<header>
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="stylesheet" href="https://cdn.auburn.edu/assets/css/bootstrap.min.css">
</header>
<body>
</body>
</HTML>