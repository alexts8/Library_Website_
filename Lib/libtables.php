<?php
$servername= "localhost";
$username = "root";
$password = "";
$dbname="libDB";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
		
	}
	echo "Connected successfully";
	



	$sql= " CREATE TABLE Users (Username VARCHAR(30) PRIMARY KEY,
								Password VARCHAR(20), FirstName VARCHAR(30), Surname VARCHAR(30),
								Address1 VARCHAR(50), Address2 VARCHAR(50), City VARCHAR(20), Telephone INT(10),
								Mobile INT(10))";
	if ($conn->query($sql) === TRUE)
		{
			echo "Table user created successfully";
		}
		else 
		{
			echo "Error creating table: " . $conn->error; 
		}
		
		
	$sql= " CREATE TABLE Category (CategoryID INT(3) UNSIGNED ZEROFILL PRIMARY KEY , CategoryDesc VARCHAR(20))";
	if ($conn->query($sql) === TRUE)
		{
			echo "Table user created successfully";
		}
		else 
		{
			echo "Error creating table: " . $conn->error; 
		}
		

	$sql= " CREATE TABLE Books (ISBN VARCHAR(30) PRIMARY KEY,
								BookTitle VARCHAR(50), Author VARCHAR(50), Edition VARCHAR(1),
								Year INT(4), Category INT(3) UNSIGNED ZEROFILL, Rese VARCHAR(1), FOREIGN KEY (Category) REFERENCES Category(CategoryID))";
	if ($conn->query($sql) === TRUE)
		{
			echo "Table user created successfully";
		}
		else 
		{
			echo "Error creating table: " . $conn->error; 
		}
		
	
	$sql= " CREATE TABLE Reservations (ISBN VARCHAR(30) PRIMARY KEY, Username VARCHAR(30), ReserveDate DATE,
			FOREIGN KEY (ISBN) REFERENCES Books(ISBN), FOREIGN KEY (Username) REFERENCES Users(Username))";
	if ($conn->query($sql) === TRUE)
		{
			echo "Table user created successfully";
		}
		else 
		{
			echo "Error creating table: " . $conn->error; 
		}
		

		
	$conn->close();
?>