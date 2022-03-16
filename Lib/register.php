<html>
<div id="page">
<head>
<p>

<link rel="stylesheet" href="libstyle.css">
<h1> Register new User </h1>

<hr>

</head>

<div class="main">
<?php
//establish connection
$servername= "localhost";
$username = "root";
$password = "";
$dbname="libDB";
$conn = new mysqli($servername, $username, $password, $dbname);

//start session and reset username (logout)
session_start();
unset($_SESSION['un']);


if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
		
	}
echo "";



//insert data from form into users table
if ( isset($_POST['Username'])&& isset($_POST['Password1'])&& isset($_POST['Password2'])&& isset($_POST['FirstName'])
	&& isset($_POST['LastName'])&& isset($_POST['Add1'])&& isset($_POST['Add2'])
	&& isset($_POST['City'])&& isset($_POST['Telephone'])&& isset($_POST['Mobile']))
	{
	
	if ($_POST['Password1'] != $_POST['Password2']) 
	{
		$_SESSION['error'][] = "Passwords don't match";
		echo"ERROR: Passwords must match.";
	}
	else
	{

	
		
		$un = $_POST['Username'];
		$p1 = $_POST['Password1'];
		$p2 = $_POST['Password2'];
		$f = $_POST['FirstName'];
		$l = $_POST['LastName'];
		$a1 = $_POST['Add1'];
		$a2 = $_POST['Add2'];
		$c = $_POST['City'];
		$t = $_POST['Telephone'];
		$m = $_POST['Mobile'];
		$_SESSION['un']=$_POST['Username'];
		
		
		
		$sql= "INSERT INTO Users (UserName, Password, FirstName, Surname, Address1, Address2, City, Telephone, Mobile) 
				VALUES( '$un', '$p1', '$f', '$l', '$a1', '$a2', '$c', '$t', '$m')";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully, to continue to the library system, ";
			echo '<a href= "search.php">click here!</a>';
			
			}
			else 
			{
				echo "Error: " . $sql. "<br>" . $conn->error; 
			}
				$conn->close(); 
				
	}
	}
?>
</div>
	
<p>Register:</p>
<form method="post">
<p>Username:<input type="text" name="Username" required></p>
<p>Password:<input type="password" name="Password1" maxlength="6" required></p>
<p>Confirm Password:<input type="password" name="Password2" maxlength="6" required></p>

<p>First Name:<input type="text" name="FirstName" required></p>
<p>Last Name:<input type="text" name="LastName" required></p>
<p>Address1:<input type="text" name="Add1" required></p>
<p>Address2:<input type="text" name="Add2" required></p>
<p>City:<input type="text" name="City" required></p>
<p>Telephone:<input type="number" name="Telephone" maxlength="10" required></p>
<p>Mobile:<input type="number" name="Mobile" maxlength="10" required></p>

<p><input type="submit" value="Add New"/></p>
</form>
</div>

<footer id="foot">
  Alex Tsiogas 2020
</footer>


</html>
