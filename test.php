<?
	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$db = mysqli_connect('us-cdbr-iron-east-02.cleardb.net', 'bcd2f7930ec787', '06fbf25c', 'heroku_85857c074ef2ccf', 3306); or die('Error: Unable to Connect');
?>