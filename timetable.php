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
  <h4>Teaching Timetable</h4>
    <div class="table-wrapper">
      <table class="table">
        
        <thead>
          <tr>
          <td>No.</td>
            <td>Teacher Name</td>
            <td>Student Name</td> 
            <td>Day</td>                    
            <td>Time in</td>
            <td>Time Out</td>
            <td>Class Location</td>
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
          $query = "SELECT * FROM teacher_student_schedule";
    $result = mysqli_query($conn, $query);
    
    $counter = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        if($row['teacherName'] != "" && $row['studentName'] != "") {  
            echo "<tr>";
            echo "<td>" . $counter . "</td>";            
            echo "<td>" ;
            echo '<i class="fas fa-chalkboard-teacher" ></i>'; 
            echo '<h3>' . $row['teacherName'] . '</h3>';            
            echo"</td>";
            echo "<td>" . $row['studentName'] . "</td>";
            echo "<td>" . ucwords($row['day']) . "</td>";
            echo "<td>" . $row['timeIn'] . "</td>";
            echo "<td>" . $row['timeOut'] . "</td>";
            echo "<td>" . $row['student_location'] . "</td>";
            
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