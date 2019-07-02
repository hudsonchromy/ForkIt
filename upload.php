//server side for index which adds pictures of a fork

<?php
	require './add/vendor/autoload.php';
	
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
	// AWS Info
	$bucketName = getenv('bucketName');
	$IAM_KEY = getenv('s3Key');
	$IAM_SECRET = getenv('s3secret');
	try {
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest', 
				'region'  => 'us-east-2'
			)
		);
	} catch (Exception $e) {
		die("Error: " . $e->getMessage());
	}
	
	function getName() { 
	    $characters = '02468abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	  
	    for ($i = 0; $i < 10; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	  
	    return $randomString . "jpg"; 
	} 


	$keyName = getName() . pathinfo($_FILES["fileToUpload"]['name'], PATHINFO_EXTENSION);
	$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUpload"]['tmp_name'];
		$s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file,
				'StorageClass' => 'REDUCED_REDUNDANCY'
			)
		);
	} catch (S3Exception $e) {
		die('Error:' . $e->getMessage());
	} catch (Exception $e) {
		die('Error:' . $e->getMessage());
	}

	$forkName = $_POST['restaurant'];

	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, 'ForkIt') or die('Error: Unable to Connect');

	$qry = "INSERT INTO images (path, fork) VALUES ('$keyName', '$forkName')";
	echo $qry;
	mysqli_query($db, $qry) or die ('error: not able to save');


	echo 'Done';
?>








