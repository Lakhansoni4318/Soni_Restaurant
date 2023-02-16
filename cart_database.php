<?php
$insert = false;
if(isset($_POST['Item_Name'])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

    $Item_Name = $_POST['Item_Name'];
    $Price = $_POST['Price'];

$sql = "INSERT INTO food (Item_Name, Price) VALUES ('$Item_Name', '$Price')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}



?>