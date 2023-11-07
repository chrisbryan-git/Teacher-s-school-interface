<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>timetable</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="container">    
<!-- Sidebar -->
<aside class="sidebar">
        <nav>
        <img src="logo.jpg" alt="" srcset="" style="width:150px; border-radius:20px; margin-top:20px;"> 
        <div class="sidebar-menu"><h4 class="menu-header">TEACHER'S PORTAL</h4>
                <hr>
                <ul class="list-unstyled">
                    <li><a href="index.php">Fill Attendance</a></li>
                </ul>
                <ul class="list-unstyled">
                    <li><a href="timetable.php">Teaching Timetable</a></li>
                </ul>
                <ul class="list-unstyled">
                    <li><a href="exam_timetable.php">Exam Timetable</a></li>
                </ul>
                <ul class="list-unstyled">
                    <li><a href="profile.php">Teacher's Profile</a></li>
                </ul>                
            </div>
            <hr>                
        </nav>
    </aside>

    <section id="navigation">
        <div class="navbar-brand">
            <div> 
                <div>
                    <i id="sidebar-btn" class="fas fa-bars"></i>
                </div>    
        </div>
        </div>

    <dir class="board" style="background-color: whitesmoke; box-shadow: 0px 0px 10px blue;">
  <div class="table-container">
  <h4>Exam Schedule</h4>
    <div class="table-wrapper">
      <table class="table">
        
        <thead>
          <tr>
          <td>No.</td>
            <td>Student Name</td>
            <td>Day Of Exam</td> 
            <td>Subject</td>   
            <td>Type OF Exam</td>   
            <td>Exam Out OF:</td>               
            <td>Date Of Exams</td>
            <td>Time Of Exams</td>
            <td>Exam Center/Location</td>
            <td>Supervisor</td>
            <td>Subject Teacher</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "school";
          $conn = new mysqli($servername, $username, $password, $dbname);
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }
          $query = "SELECT * FROM exam_timetable";
    $result = mysqli_query($conn, $query);
    
    $counter = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        if($row['teacher_name'] != "" && $row['student_name'] != "") {  
            echo "<tr>";
            echo "<td>" . $counter . "</td>";            
            echo "<td>" ;
            // echo '<i class="fas fa-chalkboard-teacher" ></i>'; 
            echo '<h3>' . $row['student_name'] . '</h3>';            
            echo"</td>";
            echo "<td>" . $row['day'] . "</td>";
            echo "<td>" . ucwords($row['subject']) . "</td>";
            echo "<td>" . $row['type_of_exam'] . "</td>";
            echo "<td>" . $row['exam_out_of'] . "</td>";
            echo "<td>" . $row['date_of_exams'] . "</td>";
            echo "<td>" . $row['start_time'] . "</td>";
            echo "<td>" . $row['exam_center'] . "</td>";
            echo "<td>" . $row['supervised_by'] . "</td>";
            echo "<td>" . $row['teacher_name'] . "</td>";
            
            echo "</tr>";
            
            $counter++;
        }
    }
          ?>
        </tbody>
      </table>
    </div>
  </div>

<script src="main.js"></script>
</body>
</html>