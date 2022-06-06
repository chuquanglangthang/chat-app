<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chat";

    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    // Check connection
    if(!$conn){
        // if database is not connected, show error message
        echo "Connection failed:" . mysqli_connect_error();
    }
?>