<?php

function album_data($album_id) {

	$album_id = (int)$album_id;

	$args = func_get_args();
	unset($args[0]);
	//$fields = implode('`, `', $args).'`';
	$fields = '`' . implode('`, `', $args) . '`';	
	$querystr = "SELECT $fields FROM `albums` WHERE `album_id`=$album_id AND `user_id`=".$_SESSION['user_id'] or die(mysql_error());
	//echo $querystr;
	$query = mysql_query($querystr) or die(mysql_error());
	// $query = mysql_query("SELECT $fields FROM `users` WHERE `user_id`=".$_SESSION['user_id']) or die(mysql_error());
	$query_result = mysql_fetch_assoc($query);
	foreach ($args as $field) {
		$args[$field] = $query_result[$field];
	}
	return $args;
}

function album_check($album_id) {
	$album_id = (int)$album_id;
	$query = mysql_query("SELECT COUNT(`album_id`) FROM `albums` WHERE `album_id`=$album_id AND `user_id`=".$_SESSION['user_id']);
	return (mysql_result($query, 0) == 1) ? true : false;
}

function get_albums() {
	$albums = array();

	$albums_query = mysql_query("
	SELECT `albums`.`album_id`, `albums`.`timestamp`, `albums`.`name`, 
	LEFT(`albums`.`description`, 50) as `description`, COUNT(`images`.`image_id`) as `image_count` 
	FROM `albums`
	LEFT JOIN `images`
	ON `albums`.`album_id` = `images`.`album_id`
	WHERE `albums`.`user_id` = ".$_SESSION['user_id']."
	GROUP BY `albums`.`album_id`
	");

	while ($album_row = mysql_fetch_assoc($albums_query)) {
		$albums[] = array(
				'id' => $album_row['album_id'],
				'timestamp' => $album_row['timestamp'],
				'name' => $album_row['name'],
				'description' => $album_row['description'],
				'count' => $album_row['image_count']

			);
	}

	return $albums;

}

function create_album($album_name, $album_description) {
	$album_name = mysql_real_escape_string(htmlentities($album_name));
	$album_description = mysql_real_escape_string(htmlentities($album_description));
	mysql_query("INSERT INTO `albums` VALUES ('', '".$_SESSION['user_id']."', UNIX_TIMESTAMP(), '$album_name', '$album_description')") or die(mysql_error());
	mkdir('uploads/'.mysql_insert_id(), 0744);
	mkdir('uploads/thumbs/'.mysql_insert_id(), 0744);
}

function edit_album($album_id, $album_name, $album_description) {
	$album_id = (int)$album_id;
	$album_name = mysql_real_escape_string($album_name);
	$album_description = mysql_real_escape_string($album_description);

	mysql_query("UPDATE `albums` SET `name`='$album_name', `description`='$album_description' WHERE `album_id`='$album_id' AND `user_id`=".$_SESSION['user_id']) or die(mysql_error());

}


function delete_album($album_id) {
	$album_id = (int)$album_id;

	mysql_query("DELETE FROM `albums` WHERE `album_id`=$album_id AND user_id=".$_SESSION['user_id']) or die(mysql_error());
	mysql_query("DELETE FROM `images` WHERE `album_id`=$album_id AND user_id=".$_SESSION['user_id']) or die(mysql_error());
}

function remove_dir($album_id)   {
        $album_id = (int)$album_id;
        if (is_dir('uploads/'.$album_id))
        $dir_handle = opendir('uploads/'.$album_id);
        if (!$dir_handle)
        return false;
        while($file = readdir($dir_handle)) {
            if ($file != '.' && $file != '..') {
                if (!is_dir('uploads/'.$album_id.'/'.$file))
                unlink('uploads/'.$album_id.'/'.$file);
                else
                {
                    $a='uploads/'.$album_id.'/'.$file;
                    removedir($a);
                }
            }
        }
        closedir($dir_handle);
        rmdir('uploads/'.$album_id);
        return true;
}

function remove_dir_thumbs($album_id) {
        $album_id = (int)$album_id;
        if (is_dir('uploads/thumbs/'.$album_id))
        $dir_handle = opendir('uploads/thumbs/'.$album_id);
        if (!$dir_handle)
        return false;
        while($file = readdir($dir_handle)) {
            if ($file != '.' && $file != '..') {
                if (!is_dir('uploads/thumbs/'.$album_id.'/'.$file))
                unlink('uploads/thumbs/'.$album_id.'/'.$file);
                else
                {
                    $a='uploads/thumbs/'.$album_id.'/'.$file;
                    removedir($a);
                }
            }
        }
        closedir($dir_handle);
        rmdir('uploads/thumbs/'.$album_id);
        return true;
}

?>