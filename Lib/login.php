<html>
<div id="page">
<head>

<link rel="stylesheet" href="libstyle.css">
<h1> Welcome to the Library </h1>

<hr>

</head>


<?php
//establish connection
$servername= "localhost";
$username = "root";
$password = "";
$dbname="libDB";
$conn = new mysqli($servername, $username, $password, $dbname);

//start session & reset username (logout)
session_start();
unset($_SESSION['un']);

if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
		
	}
echo "";

//compare html form to users table. If result found, link to search page
if ( isset($_POST['Username'])&& isset($_POST['Password']))
{
	$un = $_POST['Username'];
	$p1 = $_POST['Password'];
	
	$result= mysqli_query($conn, "SELECT * FROM Users WHERE Username = '".$un."' AND Password = '".$p1."'");
	if(mysqli_num_rows($result)>0) 
	{
		$_SESSION['un']=$un;
		header( 'Location: search.php' ) ; 
		return;
	}
	else
	{
		echo"Login Failed";
	}
}
	
?>

<p class= "main">Login:</p>
<form method="post" class="main">
<p>Username:<input type="text" name="Username" required></p>
<p>Password:<input type="password" name="Password" maxlength="6" required></p>
<p><input type="submit" value="Login"/></p>
</form>

<p class="main">Not registered? Register <a href= "register.php">here!</a></p>
</div>

<footer id="foot">
  Alex Tsiogas 2020
</footer>