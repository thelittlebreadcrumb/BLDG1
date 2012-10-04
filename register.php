<?php
include 'init.php';

if (logged_in()) {
	header('Location: index.php');
	exit();
}

include './template/header.php';
?>

<h3>Register</h3>


<?php
//echo "here<br>"; //so it gets here
if (isset($_POST['register_email'], $_POST['register_name'], $_POST['register_password'])) {
	$register_email = $_POST['register_email'];
	$register_name = $_POST['register_name'];
	$register_password = $_POST['register_password'];

	$errors = array();
//echo "here2<br>"; //then here
	if (empty($register_email) || empty($register_name) || empty($register_password)) {
		$errors[] = 'All fields required';
//		echo "here3<br>"; //not here
	} else {
//echo "here4<br>"; //gets here
		if (filter_var($register_email, FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'Email address not valid';//echo "here11<br>";
		}

		if (strlen($register_email) > 255 || strlen($register_name) > 35 || strlen($register_password) > 35) {
			$errors[] = 'One or more fields contains too many characters';//echo "here10<br>";
		}

		if (user_exists($register_email)) { //id say the error lies here
			$errors[] = 'That email has already been registered.';//echo "here9<br>";
		}

	}
//echo "here8<br>"; //but doesn't get here.
	if (!empty($errors)) {
echo "here5<br>";
		foreach ($errors as $error) {
			echo $error, '<br />';
		}

	} else {
//echo "here6<br>";
		$register = user_register($register_email, $register_name, $register_password);
		$_SESSION['user_id'] = $register;
		echo $_SESSION['user_id'];
		header('Location: index.php');
		exit();
		

	}
//echo "here12<br>";
} else {
	//echo "something is false";
}
//echo "here7<br>";
?>

<form action="" method="post">

	<p>Email: <br> <input type="email" name="register_email" size="35" maxlength="255"></p>
	<p>Fullname: <br> <input type="text" name="register_name" maxlength="35"></p>
	<p>Password: <br> <input type="password" name="register_password" maxlength="35"></p>
	<p><input type="submit" value="Register"></p>

</form>

<?php
include './template/footer.php';
?>