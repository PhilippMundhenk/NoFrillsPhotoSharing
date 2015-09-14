<?php
session_start();
$password = $userError = $passError = '';
$expectedPassword = 'password';
if(isset($_POST['sub']))
{
	$password = $_POST['password'];
	if($password === $expectedPassword)
	{
		$_SESSION['login'] = true;
		setcookie('login', 'true');
		header('LOCATION:upload.php');
		die();
	}
	if($password !== $expectedPassword)
	{
		$passError = 'Invalid Password';
	}
}
//This is a security flaw! Password is send in clear
if(isset($_GET["pw"]))
{
	if($_GET["pw"] === $expectedPassword)
	{
		$_SESSION['login'] = true;
		header('LOCATION:upload.php');
		die();
	}
}
if(isset($_COOKIE['login']))
{
	$_SESSION['login'] = true;
	header('LOCATION:upload.php');
	die();
}
echo "<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
	<!-- Fonts -->
  	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Redressed:400|Arvo:400,700|Pinyon+Script:400,700'>
	<meta http-equiv='content-type' content='text/html;charset=utf-8' />
	<title>Photo Sharing</title>
	<link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
	<div class='loginPage'>
		<h2 class='titleLine' dir='ltr' id='titleLineID'>Photo Sharing</h2>
		<div class='loginButton'>
			<form name='input' action='{$_SERVER['PHP_SELF']}' method='post' style='display: block;text-align: center;'>
				<label for='password' class='loginLabel'>Password?</label><br/><br/>
				<div class='loginError'>$passError</div>
				<div style='text-align: center;'>
					<input type='password' value='$password' id='password' name='password' placeholder='*****' style='margin: 0 auto;text-align: center;display: block;width:60%;font-size:8rem;margin-bottom:10px; />
				</div>
				<label for='sub' style='text-align: center;'>
					<input type='image' src='login.png' class='loginIcon' height='200px' style='padding:1% 1%;'></th>
				</label>
				<input type='hidden' name='sub' id='sub'>
			</form>
		</div>
	</div>
</body>
</html>";
?>