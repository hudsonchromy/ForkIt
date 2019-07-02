<?php include('../add/server.php')?>
<?php include('../topnav.php')?>
<HTML>
	<head>
		<title>ForkIt - Add Review</title>
		<?php include('../cdns.php')?>
	</head>
	<body>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<div class="small-inputs">
				<div class="input-box">
					<label>Restaurant: </label>
					<input type="text" name="restaurant"></input>
				</div>
				<div class="input-box">
					<label>Rating: </label>
					<?
					$name = "rating";
					$order = 1;
					include('stars.php')?>
				</div>
				<div class="input-box">
					<label>Durability: </label>
					<?
					$name = "durability";
					$order = 2;
					include('stars.php')?>
				</div>
				<div class="input-box">
					<label>Looks: </label>
					<?
					$name = "looks";
					$order = 3;
					include('stars.php')?>
				</div>
				<label>Review: </label>
			</div>
			<textarea name="reviewText" style="width:100%; height:300px;"></textarea>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<button type="submit" name="submit">Add Fork</button>
		</form>
	</body>
</HTML>