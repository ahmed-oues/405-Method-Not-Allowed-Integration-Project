<?php
require_once('sessonchekadmin.php');


// Database configuration
$host = "localhost";
$username = "sammy";
$password = "password";
$database = "greatmove_library";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET["id"];

// checking if the id exists
if ($sql = "SELECT * FROM users WHERE id='$id' " ){

    $sql ="DELETE FROM users WHERE id = '$id'";
    if($conn->query($sql)==TRUE){
        echo "user deleted succesfully";
    }

}
else{

    echo "Error : The user ID doesn't exist. ";

}