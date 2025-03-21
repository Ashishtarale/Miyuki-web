<?php
    $conn = new mysqli("148.72.245.251","santosh_miyuki","dku^U,N1jYa8","miyuki-admin");
    // Check connection
    if ($conn -> connect_errno) {
      echo "Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }
?>