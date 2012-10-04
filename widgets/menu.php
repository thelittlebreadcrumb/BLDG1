<a href="index.php">Home</a> / 
<?php
	//if the user is not logged in, show the register link. If he is, show the Logout link.
	if (!logged_in()) {

?>
<a href="register.php">Register</a>

<?php
} else {
?>

<a href="logout.php">Logout</a> /
<a href="create_album.php">Create Album</a> /
<a href="albums.php">Albums</a> /
<a href="upload_image.php">Upload Image</a> /

<?php
}
?>