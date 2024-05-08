<?php

session_start();
include("includes/db.php");
include("includes/sidebar.php");
include("includes/header.php");

?>

<body>
    <div class="main-content">
        <main>
            <div class="main-content"></div>
            <div class="page-content"></div>
            <div class="container">
                <h1 color="blue">Exam Details</h1>
                <form action="examhandling.php" method="post">
                    <fieldset>
                        <div class="field-box">
                            <label for="invigilator">Invigilator:</label>
                            <input type="text" name="invigilator" placeholder="eg A Dube" id="invigilator">

                            <label for="examiner">Examiner:</label>
                            <input type="text" name="examiner" placeholder="eg T Sithole" id="examiner">

                            <label for="course_code">Course Code:</label>
                            <?php

                            // Include the database connection file
                            $host = "localhost";
                            $dbname = "qrcode";
                            $username = "root";
                            $password = "";

                            try {
                                // Create a PDO connection object
                                $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

                                // Set error mode to exceptions
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            } catch (PDOException $e) {
                                echo "Error connecting to database: " . $e->getMessage();
                                exit;
                            }

                            // Execute the query to retrieve course data (using PDO for improved security and error handling)
                            try {
                                $sql = "SELECT course_code, course_name FROM courses";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                                exit;
                            }

                            if ($courses) { // Check if any courses were found
                            ?>

                                <select name="course_code" id="course_code">
                                    <?php
                                    foreach ($courses as $course) {
                                    ?>
                                        <option value="<?php echo $course['course_code']; ?>"><?php echo $course['course_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            <?php
                            } else {
                                echo "No courses found.";
                            }
                            ?>
                            <label for="venue">Venue:</label>
                            <select name="venue" id="venue">
                                <option value="">SELECT VENUE</option>
                                <option value=""></option>

                            </select>


                            <label for="date">Date:</label>
                            <input type="datetime" name="date" placeholder="eg 2024/05/05" id="date">


                            <label for="session">Session:</label>
                            <input type="radio" name="session" id="session" value="MORNING">MORNING
                            <input type="radio" name="session" id="session" value="AFTERNOON">AFTERNOON

                            <a href="examhandling.php"><button type="submit">Done..</button></a>
                        </div>
                    </fieldset>
                </form>
            </div>
    </div>
    </div>
    </main>
    </div>
</body>

</html>