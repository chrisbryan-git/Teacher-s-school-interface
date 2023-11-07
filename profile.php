<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cares-digital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
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

    <div class="container">
        <div class="board" style="background-color: whitesmoke; box-shadow: 0px 0px 10px blue;">
            <form method="post" action="profile.php">
                <div class="row" style="margin-top:20px">
                 <input type="text" class="form-control" name="personal_id" placeholder="Enter PersonalID">
                <input type="submit" class="btn btn-primary" value="view profile">
                </div>
            </form>
        </div>
        <div class="board" style="background-color: whitesmoke; box-shadow: 0px 0px 10px blue;">
            <div class="teacher-details">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {                
                    $personalId = $_POST["personal_id"];                
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "school";                
                    $conn = new mysqli($servername, $username, $password, $dbname);                
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }                
                    $sql = "SELECT * FROM teacher_table WHERE personalId = ?";
                    $stmt = $conn->prepare($sql);                
                    $stmt->bind_param("s", $personalId);                
                    $stmt->execute();                
                    $result = $stmt->get_result();                
                    if ($result->num_rows > 0) {                    
                        echo '<h2 style="font-family:monotype corsiva; color:green">Teacher Details:</h2>';
                        echo "<table style='font-size:18px'>";
                        while ($row = $result->fetch_assoc()) {                
                            
                            echo "<tr><td>Teacher Name: " . (isset($row["teacherName"]) ? $row["teacherName"] : "") . "</td><td>Residence: " . (isset($row["residence"]) ? $row["residence"] : "") . "</td></tr>";
                            echo "<tr><td>Date Employed: " . (isset($row["date_employed"]) ? $row["date_employed"] : "") . "</td><td>TSC No.: " . (isset($row["teacher_tsc"]) ? $row["teacher_tsc"] : "") . "</td></tr>"; 
                            echo "<tr><td>Mobile Phone: " . (isset($row["mobilePhone"]) ? $row["mobilePhone"] : "") . "</td><td>Email: " . (isset($row["email"]) ? $row["email"] : "") . "</td></tr>";
                            echo "<tr><td>Subject Combination: " . (isset($row["subjectCombination"]) ? $row["subjectCombination"] : "") . "</td><td>Qualification: " . (isset($row["qualification"]) ? $row["qualification"] : "") . "</td></tr>";
                            echo "<tr><td>Gender: " . (isset($row["gender"]) ? $row["gender"] : "") . "</td></tr>";        
                        }
                        echo "</table>";
                        $sessionSql = "SELECT * FROM teacher_student_schedule WHERE personalId = ?";
                        $sessionStmt = $conn->prepare($sessionSql);        
                        $sessionStmt->bind_param("s", $personalId);        
                        $sessionStmt->execute();        
                        $sessionResult = $sessionStmt->get_result();
                        if ($sessionResult->num_rows > 0) {
                            echo " ";
                            echo '<h2 style="font-family:monotype corsiva; color:green">Your Sessions:</h2>';
                            echo '<div class="table-wrapper">';
                            echo '<table class="table">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>No</th>';
                            echo '<th>STUDENT NAME</th>';
                            echo '<th>DATE</th>';
                            echo '<th>SUBJECT</th>';
                            echo '<th>TOPIC</th>';
                            echo '<th>SUB-TOPIC</th>';
                            echo '<th>COMMENTS</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            $counter = 1;
                            while ($sessionRow = $sessionResult->fetch_assoc()) {
                                echo '<tr ">';
                                echo "<td>" . $counter . "</td>";
                                echo '<td>' . (isset($sessionRow["studentName"]) ? $sessionRow["studentName"] : "") . '</td>';
                                echo '<td>' . (isset($sessionRow["date"]) ? $sessionRow["date"] : "") . '</td>';
                                echo '<td>' . (isset($sessionRow["subject"]) ? $sessionRow["subject"] : "") . '</td>';
                                echo '<td>' . (isset($sessionRow["topic"]) ? $sessionRow["topic"] : "") . '</td>';
                                echo '<td>' . (isset($sessionRow["subtopic"]) ? $sessionRow["subtopic"] : "") . '</td>';
                                echo '<td>' . (isset($sessionRow["comments"]) ? $sessionRow["comments"] : "") . '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                        } else {
                            echo "No sessions found for the provided personal ID.";
                        }
                        $sessionStmt->close();
                    } else {
                        echo "No results found for the provided personal ID.";
                    }
                    $stmt->close();
                    $conn->close();
                }
                ?>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>