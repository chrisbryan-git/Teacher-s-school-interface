<?php
$conn = mysqli_connect('localhost', 'root', 'omulodi54', 'school');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $teacherName = $_POST["teacherName"];
  $personalId = $_POST["personalid"];
  $studentName = $_POST["studentName"];
  $date = $_POST["date"];
  $timeIn = $_POST["timeIn"];
  $timeOut = $_POST["timeOut"];
  $subject = $_POST["subject"];
  $topic = $_POST["topic"];
  $subtopic = $_POST["subtopic"];
  $comments = $_POST["comments"];
  
  // matching personalId and teacherName 
  $query = "SELECT COUNT(*) AS count FROM teacher_table WHERE personalId = '$personalId' AND teacherName = '$teacherName'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $count = $row['count'];
  
  if ($count > 0) {
    // Check if the record already exists 
    $checkQuery = "SELECT COUNT(*) AS count FROM teacher_student_schedule WHERE teacherName = '$teacherName' AND personalId = '$personalId' AND studentName = '$studentName' AND date = '$date' AND timeIn = '$timeIn' AND timeOut = '$timeOut' AND subject = '$subject' AND topic = '$topic' AND subtopic = '$subtopic' AND comments = '$comments'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkRow = mysqli_fetch_assoc($checkResult);
    $checkCount = $checkRow['count'];
    
    if ($checkCount > 0) {
      // error iif record exists
      echo "<script> alert('Error! Record already exists.');window.location.href='attendance_form.php';</script>";
      exit();
    } else {
      // Insert data 
      $stmt = $conn->prepare("INSERT INTO teacher_student_schedule (teacherName, personalId, studentName, date, timeIn, timeOut, subject, topic, subtopic, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sissssssss", $teacherName, $personalId, $studentName, $date, $timeIn, $timeOut, $subject, $topic, $subtopic, $comments);
      $stmt->execute();
      $stmt->close();
      echo "<script> alert('Record inserted successfully!');window.location.href='attendance_form.php';</script>";
      exit();
    }
  } else {
    
    echo "<script> alert('Error! Check your personal ID. and try again...');window.location.href='attendance_form.php';</script>";
    exit();
  }
  
  mysqli_close($conn);
}
?>