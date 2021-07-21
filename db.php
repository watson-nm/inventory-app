<?php
$host = 'localhost';  // server
$user = 'root';
$pass = "";
$database = 'test_inventory';   //Database Name
$results_per_page = 20;

// establishing connection
  $conn = mysqli_connect($host,$user,$pass,$database);

 // for displaying an error msg in case the connection is not established
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>
