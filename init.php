<?php

ob_start();
session_start();

<<<<<<< HEAD
mysql_connect('localhost','root','123456');
=======
mysql_connect('localhost','root','');
>>>>>>> 55c350acadfa25f84ea8b7898837fb2aedad48ef
mysql_select_db('visualupload');

include '/func/user.func.php';
include '/func/album.func.php';
include '/func/image.func.php';
include '/func/thumb.func.php';

?>