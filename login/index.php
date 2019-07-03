<?php include('../login/loginServer.php')?>
<HTML>
	<head>
		<title>ForkIt - Login</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body>
		<a href="/">
			<div class="top-banner">
				<img src="../images/fork.png">
			</div>
		</a>
		<?php include('../errors.php')?>
		<form action="/login/" method="post">
			<div class="input-box">
				<input type="text" name="username" placeholder="Username"></input>
				<input type="password" name="password" placeholder="Password"></input>
			</div>
			<button type="submit" name="submit">Sign-In</button>
			<p>New to Fork It? <a href="../register">Sign Up</p>
		</form>
	</body>
</HTML>