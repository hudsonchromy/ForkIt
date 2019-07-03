<?php include('../add/server.php')?>
<?php include('../topnav.php')?>

<HTML>
	<head>
		<title>ForkIt - <?echo $_SESSION["username"]; ?></title>
		<?php include('../cdns.php')?>
	</head>
	<body>
		<h2><?echo $_SESSION["username"]; ?></h2>
		<h3>Your Reviews</h3>
		<div class="scrollmenu">

			<?
			$HOST = getenv('host');
			$USERNAME = getenv('username');
			$PASSWORD = getenv('password');
			$DBNAME = getenv('dbname');
			$db = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DBNAME, 3306) or die('Error: Unable to Connect');
			
			require '../add/vendor/autoload.php';
			use Aws\S3\S3Client;
			use Aws\S3\Exception\S3Exception;


			$userId = $_SESSION['userId'];
			$userReviews = "SELECT * FROM Reviews WHERE userId='1'";
			$results = mysqli_query($db, $userReviews);
			echo mysqli_num_rows($results);
			while($result = mysqli_fetch_assoc($results)):
				echo "string";
			?>
				<div class="card">
					 <?
					$restaurantId = $result['restaurantId'];
					$restaurantFind = "SELECT * FROM Forks WHERE id = '$restaurantId'";
					$restaurantQ = mysqli_query($db, $restaurantFind);
					$restaurant = mysqli_fetch_assoc($restaurantQ)['restaurant'];
					echo $restaurant; ?>
					<?
					$bucketName = getenv('bucketName');
					$IAM_KEY = getenv('s3Key');
					$IAM_SECRET = getenv('s3secret');
					$reviewId = $result['id'];
					$image = mysqli_query($db, "SELECT * FROM images WHERE reviewId='$reviewId'") or die("Error: Invalid request");
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
				  while($row = mysqli_fetch_array($image)) {
				    $keyPath = $row['path'];
				  
				  // Get file
				  
				    $r = $s3->getObject(array(
				      'Bucket' => $BUCKET_NAME,
				      'Key'    => $keyPath
				    ));
				    // Display it in the browser
				    echo "<img src='https://forkitreviews.s3.us-east-2.amazonaws.com/$keyPath'>";
				}

					?>
					<?
					$stars = $result['rating'];
					include('../stars.php')?>
				</div>
			<?endwhile;?>


		</div>
		<h3>Saved</h3>
		<div class="scrollmenu">
		</div>

	</body>
</HTML>