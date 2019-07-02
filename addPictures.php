//form to add pictures of a fork

<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    Fork Name
    <input type="text" name="forkName" id="forkName">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>