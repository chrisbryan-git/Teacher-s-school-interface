<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>cares-digital</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
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
                    <li><a href="timetable.php">Exam Timetable</a></li>
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

    <div class="board" style="background-color: whitesmoke; box-shadow: 0px 0px 10px blue;">
    <form action="connect_teacher_student_schedule.php" method="post" class="form-box">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="teacherName">Teacher's Name</label>
                <select class="form-control" id="teacherName" name="teacherName" required>
                    <option value="">Choose Your Name</option>
                    <?php
                        // Create connection
                        $conn = mysqli_connect('localhost', 'root', '', 'school');
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        echo "Connected successfully";
                        $result = mysqli_query($conn, "SELECT teacherName FROM teacher_table");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option>{$row['teacherName']}</option>";
                        }
                        mysqli_close($conn);
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="personalId">Personal ID</label>
                <input type="number" id="personalid" name="personalid" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="studentName">Student's Name</label>
                <select type="text" id="studentName" name="studentName" class="form-control" required>
                    <option value="">Select Student</option>
                    <?php
                        // Create connection
                        $conn = mysqli_connect('localhost', 'root', '', 'school');
                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        echo "Connected successfully";
                        $result = mysqli_query($conn, "SELECT student_name FROM students_table");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option>{$row['student_name']}</option>";
                        }
                        mysqli_close($conn);
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="timeIn">Time In</label>
                <input type="time" id="timeIn" name="timeIn" class="form-control" readonly>
            </div>
            <div class="col-md-3">
                <label for="timeOut">Time Out</label>
                <input type="time" id="timeOut" name="timeOut" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="topic">Topic</label>
                <input type="text" id="topic" name="topic" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="subtopic">Subtopic</label>
                <input type="text" id="subtopic" name="subtopic" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="comments">Comments</label>
                <textarea id="comments" name="comments" class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="row">
    <div class="">
        <button name="backBtn" type="button" onclick="history.back()" class="btn btn-secondary">Back</button>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
    </form>
    <div>
        <script>
            // Getting current date pre-filled 
            var today = new Date().toISOString().split("T")[0];  
            document.getElementById("date").value = today;
            // Getting the current time prefilled in the time in
            const updateTime = () => {
                const now = new Date();
                const currentTime =  `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}:${String(now.getSeconds()).padStart(2, '0')}` ;
                document.getElementById('timeIn').value = currentTime;
            };
            setInterval(updateTime, 1000);
        </script>
    </div>
    
    <script src="main.js"></script>
</body>
</html>