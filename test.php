<?
	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$db = mysqli_connect('us-cdbr-iron-east-02.cleardb.net', 'b2a6cb9657881f', 'c0f2177', 'heroku_0eff3e82d762b77', 3306); or die('Error: Unable to Connect');
?>