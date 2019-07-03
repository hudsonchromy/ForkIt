<?
	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, 'ForkIt') or die('Error: Unable to Connect');
?>