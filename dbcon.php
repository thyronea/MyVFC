<?php

// Create connection
  $servername = "localhost";
  $username = "thyronea";
  $password = "Grayson2019!";
  $database = "VFC";

  $con = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
?>
