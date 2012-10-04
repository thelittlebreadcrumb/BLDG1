<?php

function logged_in() {
	return isset($_SESSION['user_id']);
}

function login_check($email, $password) {
	// echo checking $email
	$email = mysql_real_escape_string($email);
	$login_query = mysql_query("SELECT COUNT(`user_id`) as `count`, `user_id` FROM `users` WHERE `email`='$email' AND `password`='".md5($password)."'") or die(mysql_error());
	return (mysql_result($login_query, 0) == 1) ? mysql_result($login_query, 0, 'user_id') : false;
}

function user_data() {
	$args = func_get_args();
	//$fields = implode('`, `', $args).'`';
	$fields = '`' . implode('`, `', $args) . '`';	
	$querystr = "SELECT $fields FROM `users` WHERE `user_id`=".$_SESSION['user_id'];
	//echo $querystr;
	$query = mysql_query($querystr) or die(mysql_error());
	// $query = mysql_query("SELECT $fields FROM `users` WHERE `user_id`=".$_SESSION['user_id']) or die(mysql_error());
	$query_result = mysql_fetch_assoc($query);
	foreach ($args as $field) {
		$args[$field] = $query_result[$field];
	}
	return $args;
}

function user_register($email, $name, $password) {
	//echo "registering $email $name $password<br>";
	$email = mysql_real_escape_string ($email);
	$name = mysql_real_escape_string ($name);
	mysql_query("INSERT INTO `users` VALUES ('', '$email', '$name', '".md5($password)."')") or die(mysql_error());
	return mysql_insert_id();
}

function user_exists($email) {
	//echo "checking $email<br>";
	$email = mysql_real_escape_string ($email);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'") or die(mysql_error());
	$exists = mysql_result($query, 0) == 1;
	return $exists;
}

?>