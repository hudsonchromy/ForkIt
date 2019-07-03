<?php

	$bucketName = getenv('bucketName');
	$IAM_KEY = getenv('s3Key');
	$IAM_SECRET = getenv('s3secret');
	echo "bucket name - " . $bucketName . " key - " . $IAM_KEY . " secret - " . $IAM_SECRET;

	$HOST = getenv('host');
	$USERNAME = getenv('username');
	$PASSWORD = getenv('password');
	$DBNAME = getenv('dbname');
	$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DBNAME, 3306) or die('Error: Unable to Connect');


	require './vendor/autoload.php';
	
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
	// AWS Info
	
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
	  
	    return $randomString . "."; 
	} 


	$keyName = getName() . pathinfo($_FILES["fileToUpload"]['name'], PATHINFO_EXTENSION);
	$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
	// Add it to S3
	try {
		// Uploaded:
		
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


	
	$qry = "INSERT INTO images (path, forkId, reviewId) VALUES ('$keyName', '$restaurantId', '$reviewId')";
	mysqli_query($db, $qry) or die ('error: not able to save');
?>








