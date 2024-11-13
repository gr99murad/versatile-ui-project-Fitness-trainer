<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "fitness-trainer";

    $conn = mysqli_connect($servername, $username, $password, $db_name);

    if(!$conn){
        die("Error: " . mysqli_connect_error()); 
    }
    // else{
    //     echo "Connection Success!";
    // }
?>

