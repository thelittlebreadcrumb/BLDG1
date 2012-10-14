<?php

include 'init.php';
include './template/header.php';

if (logged_in()) {
	echo 'Welcome, you can now start <a href="">create albums</a> and <a href="">upload images</a>';
} else {
echo '<img src="http://dummyimage.com/800x500/4d494d/686a82.gif&text=placeholder+image" title="placeholder+image">
';
}
include './template/footer.php';
?>