<?php 
$host = 'localhost';
$db_name = 'laundry_apps'; //sesuaikan dengan nama database
$username = 'root'; 
$password = ''; 

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die(json_encode(["message" => "Connection failed: " . $conn->connect_error]));
}

?>