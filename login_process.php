<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];


$sql = "SELECT * FROM teachers WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        
        $_SESSION['teacher_id'] = $row['id'];
        $_SESSION['teacher_name'] = $row['name'];
        header("Location: Main.php"); 
    } else {
        
        echo "Invalid password. <a href='login.php'>Try again</a>";
    }
} else {
    
    echo "Teacher not found. <a href='login.php'>Try again</a>";
}

$conn->close();
?>
