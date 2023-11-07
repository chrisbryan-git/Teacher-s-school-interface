<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $teacher_id = $_GET['id'];

    
    $sql = "DELETE FROM teacher_table WHERE id = $teacher_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: history(2).php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
