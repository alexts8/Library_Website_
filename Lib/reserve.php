<html>
<div id="page">
<head>

<link rel="stylesheet" href="libstyle.css">
<h1> Reservations </h1>

<hr>

</head>


<h2 class = "main"> Reserved Books:</h2>

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

$un = $_SESSION['un'];
	
//use sql statement to enter reservation data for user

if( isset($_GET['ISBN'])&& isset($_SESSION['un']))
{
	$Date = date('Y-m-d');
	$ISBN = $_GET['ISBN'];
	$sql = "INSERT INTO Reservations(ISBN, Username, ReserveDate) VALUES ('$ISBN', '$un', '$Date')";
	$sql2 = "UPDATE books SET Rese = 'Y' WHERE ISBN = '$ISBN'";
	$conn->query($sql);
	$conn->query($sql2);
}




	
//sql statement selecting data for table

$sql= "SELECT books.BookTitle, Reservations.ISBN, Reservations.Username, Reservations.ReserveDate FROM Reservations INNER JOIN books ON Reservations.ISBN = books.ISBN WHERE Username = '$un'";
$result = $conn->query($sql);

if ($result->num_rows> 0) 

	{	
		echo "<table class='center' border='1'>";
			echo "<tr><td>";
			echo "Title";
			echo "</td><td>";
			echo "User";
			echo "</td><td>";
			echo "ISBN";
			echo "</td><td>";
			echo "Date Reserved";
			echo "</td><td>\n";
		
		while($row = $result->fetch_assoc()) 
		{
			echo "<tr><td>";
			echo $row["BookTitle"] ;
			echo "</td><td>";
			echo $row["Username"] ;
			echo "</td><td>";
			echo $row["ISBN"] ;
			echo "</td><td>";
			echo $row["ReserveDate"];
			echo "</td><td>\n";
			echo('<a href = "delete.php?ISBN='.($row["ISBN"]).'">Delete</a>  ');
			echo "</td></tr>";
		} 
		echo "</table>";
	}
	else 
	{
		echo "0 results";
	}




?>

</br>
<p main>
Click <a href="search.php">here</a> to return to library search.
</p>
</div>
<footer id="foot">
  Alex Tsiogas 2020
</footer>
</html>