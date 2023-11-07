<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
$personal_id = $_POST['personal_id'];


$sql = "INSERT INTO teachers (name, email, password, personal_id) VALUES ('$name', '$email', '$password', '$personal_id')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful."; 
    header("Location: Login.php");
exit; 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
