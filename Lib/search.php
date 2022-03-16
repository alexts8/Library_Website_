<html>
<div id="page">
<head>

<link rel="stylesheet" href="libstyle.css">
<h1> Library </h1>

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



<form name='form' method='post' action="search.php" class="main">

Search: <input type="text" name="search" id="search" ><br/><br/>

<input type="submit" name="submit" value="Submit">  

<br/><br/>


</form>

<br/><br/>

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
	echo "";
	
//create search variable from form	
if ( ! empty($_POST['search']))
{
    $search = $_POST['search'];
}
else
{
	$search='';
}





echo '<br/>';

//sql to select data from books table, where either booktitle or author matches wholely or partially the search variable

$sql= "SELECT * FROM books WHERE (BookTitle LIKE  '%".mysqli_real_escape_string($conn, $search)."%' OR Author LIKE  '%".mysqli_real_escape_string($conn, $search)."%') AND Rese='N'";
$result = $conn->query($sql);

if ($result->num_rows> 0) 
	
	{	
		//displaying table
		echo "<table class ='center' border='1'>";
		
			echo "<th>";
			echo "ISBN";
			echo "</th>";
			echo "<th>";
			echo "Title";
			echo "</th>";
			echo "<th>";
			echo "Author";
			echo "</th>\n";
		
		while($row = $result->fetch_assoc()) 
		{
			echo "<tr><td>";
			echo $row["ISBN"] ;
			echo "</td><td>";
			echo $row["BookTitle"];
			echo "</td><td>";
			echo $row["Author"];
			echo "</td><td>\n";
			echo('<a href = "reserve.php?ISBN='.($row["ISBN"]).'">Reserve</a>  ');
			echo "</td></tr>";
		} 
		echo "</table>";
	}
	else 
	{
		echo "0 results";
	}
	

	echo "</br>";
	echo('<a href = "reserve.php">View & Delete Reservations</a>  ');
	echo " or ";
	echo('<a href = "login.php">Logout</a>  ');
	$conn->close();
	
?>

</div>


<footer id="foot">
  Alex Tsiogas 2020
</footer>