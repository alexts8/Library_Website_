<html>
<head>
<div id="page">

<link rel="stylesheet" href="libstyle.css">
<h1> Deleted </h1>

<hr>

</head>

<?php
//check username session variable is set (prevent bypassing of login)
session_start();
if ( !isset($_SESSION['un']) ) 
{
	header("Location: login.php");
}
?>

<?php
//establish connection
$servername= "localhost";
$username = "root";
$password = "";
$dbname="libDB";
$conn = new mysqli($servername, $username, $password, $dbname);



if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
		
	}
	
	
/*if an isbn was received from previous page, 
delete row with this isbn from reservations
and set the books reservation status to "N"*/
if ( isset($_GET['ISBN']))
{	
	$ISBN = $_GET['ISBN'];
	$sql = "DELETE FROM Reservations WHERE ISBN = '$ISBN'";
	$sql2 = "UPDATE books SET Rese = 'N' WHERE ISBN = '$ISBN'";
	$conn->query($sql);
	$conn->query($sql2);
	
}
echo "Deleted! ";
echo('<a href = "reserve.php">View your Reservations</a>  ');

?>

</div>


<footer id="foot">
  Alex Tsiogas 2020
</footer>
</html>


	
	
	
	

	
	
	
	