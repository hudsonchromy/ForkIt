<?
	
	$HOST = getenv('host');
  $USERNAME = getenv('username');
  $PASSWORD = getenv('password');
  $db = mysqli_connect($HOST, $USERNAME, $PASSWORD, 'ForkIt') or die('Error: Unable to Connect');
	$forkId;
	$fork = $_GET['fork'];
	$sqlFind = "SELECT * FROM Forks WHERE restaurant = '$fork'";
	$results = mysqli_query($db, $sqlFind);
	if ($results->num_rows == 1) {
		while($row = mysqli_fetch_array($results)) {
			$forkId = $row["id"];
			echo "id: " . $row["id"] . " Restaurant: " . $row["restaurant"] . " Rating: " . $row["rating"] . " Durability: " . $row["durability"] . " Looks: " . $row["looks"];
		}
	}
	echo $forkId;

  
  $BUCKET_NAME = getenv('bucketName');
  $IAM_KEY = getenv('s3Key');
  $IAM_SECRET = getenv('s3secret');


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
  // Verify valid access code
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
   echo "</br>";
    echo "<img src='https://forkitreviews.s3.us-east-2.amazonaws.com/$keyPath' style='height: 200px'>";
  
}





echo "</br>";
// getting reviews
$sqlReviews = "SELECT * FROM Reviews WHERE restaurantId = '$forkId'";
$result = mysqli_query($db, $sqlReviews) or die("Error: Invalid request");
while($row = mysqli_fetch_array($result)) {
  echo "User " . $row['userId'];
  echo $row['reviewText'];
  echo "</br>";
  }
?>























