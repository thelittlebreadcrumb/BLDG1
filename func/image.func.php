<?php

function upload_image($image_temp, $image_ext, $album_id) {
	$album_id = (int)$album_id;

	$qar = mysql_query("INSERT INTO `images` VALUES ('', '".$_SESSION['user_id']."', '$album_id', UNIX_TIMESTAMP(), '$image_ext')") or die(mysql_error());
	$image_id = mysql_insert_id();
	// $image_file = $image_id.'.'.$image_ext'; //
	$image_file = $image_id . '.' . $image_ext;
	move_uploaded_file($image_temp, 'uploads/'.$album_id.'/'.$image_file);

	create_thumb('uploads/'.$album_id.'/', $image_file, 'uploads/thumbs/'.$album_id.'/');
}

function get_images($album_id) {

}

function image_check($image_id) {

}

function delete_image($image_id) {

}

?>