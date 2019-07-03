<?php include('../register/registerServer.php')?>
<HTML>
	<head>
		<title>ForkIt - Register</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body>
		<a href="/">
			<div class="top-banner">
				<img src="../images/fork.png">
			</div>
		</a>
		<?php include('../errors.php')?>
		<form action="/register/" method="post">
			<div class="input-box">
				<input type="text" name="username" placeholder="Username"></input>
				<input type="text" name="email" placeholder="Email"></input>
				<input type="password" name="password1" placeholder="Password"></input>
				<input type="password" name="password2" placeholder="Confirm Password"></input>
			</div>
			<hr>
			<button type="submit" name="submit">Register</button>
			<p>Returning Reviewer? <a href="../login">Sign In</p>
		</form>
	</body>
</HTML>
