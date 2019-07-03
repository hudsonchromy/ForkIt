//gets images for one fork
//
//CURRENTLY OBSOLETE
//

<?php
  $BUCKET_NAME = getenv('bucketName');
  $IAM_KEY = getenv('s3Key');
  $IAM_SECRET = getenv('s3secret');

  $forkId = $_GET['forkId'];


  require 'vendor/autoload.php';
  use Aws\S3\S3Client;
  use Aws\S3\Exception\S3Exception;
  // Get the access code
  $accessCode = $_GET['c'];
	$accessCode = strtoupper($accessCode);
  $accessCode = trim($accessCode);
  $accessCode = addslashes($accessCode);
  $accessCode = htmlspecialchars($accessCode);
  // Connect to database
  $HOST = getenv('host');
  $USERNAME = getenv('username');
  $PASSWORD = getenv('password');
  $DBNAME = getenv('dbname');
  $db = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DBNAME, 3306) or die('Error: Unable to Connect');
  $result = mysqli_query($db, "SELECT * FROM images WHERE forkId='$forkId'") or die("Error: Invalid request");
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
  
  // Get path from db
  $keyPath = '';
  while($row = mysqli_fetch_array($result)) {
    $keyPath = $row['path'];
  
  // Get file
  
    $r = $s3->getObject(array(
      'Bucket' => $BUCKET_NAME,
      'Key'    => $keyPath
    ));
    // Display it in the browser
   
    echo "<img src='https://forkitreviews.s3.us-east-2.amazonaws.com/$keyPath' style='height: 200px'>";
  
}
?>
