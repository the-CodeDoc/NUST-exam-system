<?php

session_start();
include("includes/db.php");
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
} else {
    header("Location: login.php");
    exit;
}
include("includes/db.php");
include("includes/sidebar.php");
include("includes/header.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashmaster.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Exams</title>
</head>

<body>
    <div class="main-content">
        <main>
            <div class="page-header">
                <h1>Exams</h1>
            </div>
            <div class="page-content">
                <div class="records table-responsive">
                    <div class="record-header">
                        <div class="add">
                            <a href="addexam.php"><button>Add Exam</button></a>
                            <div class="import">
                                <a href="addexam.php" style="margin-left:100%;"><button>Import Exam</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <table width="100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">INVIGILATOR:</th>
                            <th style="text-align: center;">COURSE CODE:</th>
                            <th style="text-align: center;">NO OF CANDIDATES:</th>
                            <th style="text-align: center;">DATE:</th>
                            <th style="align-items: center;">OPTION:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // Connect to the database
                        $host = 'localhost';
                        $user = 'root';
                        $password = '';
                        $dbname = 'qrcode';

                        $conn = new mysqli($host, $user, $password, $dbname);

                        if ($conn->connect_error) {
                            die('Connection failed: ' . $conn->connect_error);
                        }
                        //Query for data collection
                        $sql = "SELECT * FROM exams";
                        $result = $conn->query($sql);

                        //Display results
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr style='text-align:center;'>";
                                echo "<td>" . $row['invigilator'] . "</td>";
                                echo "<td>" . $row['course_code'] . "</td>";
                                echo "<td>" . $row['No_of_candidates'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td><div class='add'><button onclick='invigilateExam(\"" . $row['course_code'] . "\")'>Invigilate</button></div></td>"; // Button to invigilate the exam
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' style='text-align:center;'>No Exams Found</td></tr>";
                        }
                        echo "</table>";

                        // Close connection
                        $conn = null;
                        ?>
                    </tbody>
                </table>
            </div>
    </div>
    </div>
    </main>
    </div>
    <!--<footer>
      <p>NUST, Copyright &copy; 2024</p>
    </footer>-->
    <script>
        function invigilateExam(course_code){

        alert("INVIGILATING EXAM:"+course_code);
        }
    </script>
</body>

</html>