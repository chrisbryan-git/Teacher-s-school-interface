<div class="teacher-details">
    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the personal ID from the form
    $personalId = $_POST["personal_id"];

    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school";

    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to retrieve data from the 'teachers' table based on personal_id
    $sql = "SELECT * FROM teacher_table WHERE personalId = ?";
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $personalId);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any results were found
    if ($result->num_rows > 0) {
        // Output the teacher's details in a table or format of your choice
        echo "<h2>Teacher's Details:</h2>";
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            // Check if the keys exist before accessing them
            echo "<tr><td>Email: " . (isset($row["email"]) ? $row["email"] : "") . "</td></tr>";
            echo "<tr><td>Teacher Name: " . (isset($row["teacherName"]) ? $row["teacherName"] : "") . "</td><td>Residence: " . (isset($row["residence"]) ? $row["residence"] : "") . "</td></tr>";
            echo "<tr><td>Date Employed: " . (isset($row["date_employed"]) ? $row["date_employed"] : "") . "</td><td>Teacher TSC: " . (isset($row["teacher_tsc"]) ? $row["teacher_tsc"] : "") . "</td></tr>";
            echo "<tr><td>Mobile Phone: " . (isset($row["mobilePhone"]) ? $row["mobilePhone"] : "") . "</td><td>Email: " . (isset($row["email"]) ? $row["email"] : "") . "</td></tr>";
            echo "<tr><td>Subject Combination: " . (isset($row["subjectCombination"]) ? $row["subjectCombination"] : "") . "</td><td>Qualification: " . (isset($row["qualification"]) ? $row["qualification"] : "") . "</td></tr>";
            echo "<tr><td>Gender: " . (isset($row["gender"]) ? $row["gender"] : "") . "</td></tr>";
        }
        echo "</table>";

        // Prepare SQL query to retrieve sessions based on personal_id
        $sessionSql = "SELECT * FROM teacher_student_schedule WHERE personalId = ?";
        $sessionStmt = $conn->prepare($sessionSql);

        // Bind the parameter
        $sessionStmt->bind_param("s", $personalId);

        // Execute the query for sessions
        $sessionStmt->execute();

        // Get the result for sessions
        $sessionResult = $sessionStmt->get_result();


        if ($sessionResult->num_rows > 0) {
            // Output the sessions in a table under the "Sessions" section
            echo "<h2>Sessions:</h2>";
            echo "<table>";
            echo "<tr><th>Name</th><th>timeIn</th><th>timeOut</th><th>Date</th><th>Subject</th><th>Topic</th><th>Subtopic</th><th>Comments</th></tr>";
            while ($sessionRow = $sessionResult->fetch_assoc()) {
                // Check if the keys exist before accessing them
                echo "<tr><td>" . (isset($sessionRow["studentName"]) ? $sessionRow["studentName"] : "") . "</td><td>" . (isset($sessionRow["timeIn"]) ? $sessionRow["timeIn"] : "") . "</td><td>" . (isset($sessionRow["timeOut"]) ? $sessionRow["timeOut"] : "") . "</td><td>" . (isset($sessionRow["date"]) ? $sessionRow["date"] : "") . "</td><td>" . (isset($sessionRow["subject"]) ? $sessionRow["subject"] : "") . "</td><td>" . (isset($sessionRow["topic"]) ? $sessionRow["topic"] : "") . "</td><td>" . (isset($sessionRow["subtopic"]) ? $sessionRow["subtopic"] : "") . "</td><td>" . (isset($sessionRow["comments"]) ? $sessionRow["comments"] : "") . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No sessions found for the provided personal ID.";
        }

        // Close the database connection for sessions
        $sessionStmt->close();
    } else {
        echo "No results found for the provided personal ID.";
    }

    // Close the database connection for teachers
    $stmt->close();
    $conn->close();
}
?>

</div>


