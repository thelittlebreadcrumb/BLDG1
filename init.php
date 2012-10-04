<?php

ob_start();
session_start();

mysql_connect('localhost','root','123456');
mysql_select_db('visualupload');

include '/func/user.func.php';
include '/func/album.func.php';
include '/func/image.func.php';
include '/func/thumb.func.php';

?>