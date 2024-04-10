<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Final</title>
        <link rel="stylesheet" href="style.css"> <!--Import the style.css file-->
        <link rel="icon" href="./src/favicon.png"> <!--Add the icon on the tab of the browser-->
    </head>

    <body>
        <!--This is the header with the logout button and the logo title-->
        <div class="header-container">
            <button class="lbutton">
                Logout
            </button>
            <div class="cnetLogo">
                <img class="logo" src="./src/cnet.png">
            </div>
        </div>
        <!--This is the form with the fields that will be filled by the user-->
        <div class="form-container">
            <h1>Enter Course Grades</h1>
            <form class="form" onsubmit="return checkFields()" action="updatedb.php" method="post"> <!--Here I use the javascript script function checkFields()-->
                <div class="form-item">                                                             <!--to check that the fields are filled-->
                <!--Create a Drop-Down list with the students table-->
                    <label for="student">Student Name :&nbsp</label>
                    <select id="student" name="student"> <!--use name attribute to use it in the post method to get $_POST-->
                        <option value="" disabled selected>Select Student</option>
                        <!--For the drop-down list, I run the php script to query the students-->
                        <!--and then the fetched result I create the content of the drop-down list-->
                        <?php
                            $conn = mysqli_connect("localhost", "admin", "password", "challenge6"); #This is database called challenge6 and connected using admin and password.
                            $result = mysqli_query($conn, "SELECT * FROM students;");               #You can change "localhost" with "your_database_ip_address"
                            while ($entry = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$entry['studentID']."'>".$entry['firstName']." ".$entry['lastName']."</option>";
                            };
                        ?>
                    </select>
                </div>
                <div class="form-item">
                    <label for="course">Course Number :&nbsp</label>
                    <select id="course" name="course"> <!--use name attribute to use it in the post method to get $_POST-->
                        <option value="" disabled selected>Select Course</option>
                        <!--For the drop-down list, I run the php script to query the courses-->
                        <!--and then the fetched result I create the content of the drop-down list-->
                        <?php
                            $conn = mysqli_connect("localhost", "admin", "password", "challenge6");
                            $result = mysqli_query($conn, "SELECT * FROM courses;");
                            while ($entry = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$entry['courseID']."'>".$entry['courseName']."</option>";
                            };
                        ?>
                    </select>
                </div>
                <div class="form-item">
                    <label for="grade">Final Grade :&nbsp</label>
                    <input type="number" id="grade" name="grade" min="0" max="100">  <!--use name attribute to use it in the post method to get $_POST-->
                </div>
                <div class="form-item">
                    <input type="submit" name="submit" class="button">
                </div>
                <div class="form-item">
                    <input type="reset" class="button">
                </div>
            </form>
        </div>
        <!--This is the title of the table and then the table information-->
        <div class="table-container">
            <h2>
                The table below displays the contents of the database located on the Webserver
            </h2>
            <!--I create the table and the headers of the table-->
            <table class="table">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Course ID - Course Name</th>
                    <th>Grade</th>
                    <th>Letter Grade</th>
                </tr>
        <!-- This is going to be updated by PHP -->
        <?php
        // Function to convert grade to letter grade
        function convertGrade($grade) {
            if ($grade >= 95) {
                return 'A+';
            } elseif ($grade >= 90) {
                return 'A';
            } elseif ($grade >= 85) {
                return 'A-';
            } elseif ($grade >= 80) {
                return 'B+';
            } elseif ($grade >= 75) {
                return 'B';
            } elseif ($grade >= 70) {
                return 'B-';
            } elseif ($grade >= 65) {
                return 'C+';
            } elseif ($grade >= 60) {
                return 'C';
            } elseif ($grade >= 55) {
                return 'C-';
            } elseif ($grade >= 50) {
                return 'D';
            } else {
                return 'F';
            }
        }
        
        // connect and write data extracted from the Database challenge6
        $conn = mysqli_connect("localhost", "admin", "password", "challenge6"); //use the password instead of C0ntr4se;a
        $result = mysqli_query($conn, "SELECT firstName,lastName,courses.courseID,courseName,grade FROM students JOIN grades ON grades.studentID=students.studentID JOIN courses ON courses.courseID=grades.courseID;");
        while ($entry = mysqli_fetch_assoc($result)) { // I get row by row of the result from the previous query
            echo '<tr>';
                echo '<td>'.$entry['firstName'].'</td>';
                echo '<td>'.$entry['lastName'].'</td>';
                echo '<td>'.$entry['courseID'].' - '.$entry['courseName'].'</td>';
                echo '<td>'.$entry['grade'].'</td>';
                echo '<td>'.convertGrade($entry['grade']).'</tc>'; // Call the function to convert grade to letter
            echo '</tr>';
        };
        ?>
            </table>
            <button class="button">Clear Text file</button>
        </div>
        <script src="script.js"></script> <!--Import the javascript file. I put it in the end cause was having problems-->
                                          <!--And this way I ensure that the form and all the content is rendered before the script does-->
                                          <!--But I think it would work now if I import the file in the head or at the beginning-->
    </body>
</html>