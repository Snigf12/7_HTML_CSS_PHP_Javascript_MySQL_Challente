<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Final</title>
        <link rel="icon" href="./src/favicon.png"> <!--Add the icon on the tab of the browser-->
    </head>
    <body>
    <!--Add the body that will update the database and at the end redirect again to the main page-->    
        <?php
        $student = intval($_POST["student"]); //I am getting the studentID from the value of that field
                                              //Use intval to convert it to integer
        $course = $_POST["course"]; // I am getting the courseID from the value of that field this field is ok being a string
        $grade = intval($_POST["grade"]); // I am getting the grade and use intval to convert from string to integer
        
        //TESTS!!
        // echo '<p>'."$student".'</p>'; // To check the values I am getting (confirmed studentID) I need to parse to INT though
        // echo '<p>'."$course".'</p>'; // To check the values I am getting (confirmed courseID)
        // echo '<p>'."$grade".'</p>'; // To check the values I am getting (confirmed grade) I need to parse to INT though

        $conn = mysqli_connect("localhost", "admin", "password", "challenge6");
        // Use prepared statement to prevent SQL injection... Very interesting :)
        //define the statement with stmt variable and the ? ? ? are going to be the parameters of the query
        $stmt = mysqli_prepare($conn, "INSERT INTO grades (studentID, courseID, grade) VALUES (?, ?, ?)");
        //Now I send the parameters to replace the ? ? ? the "isi" part means integer string integer to tell
        mysqli_stmt_bind_param($stmt, "isi", $student, $course, $grade); // that student is integer, course is string and grade integer
        mysqli_stmt_execute($stmt); // now excecute the statement.
        mysqli_stmt_close($stmt); // close the statement to tell there are no coming more queries.

        //Redirects back to the main page after updating Database.
        header ("Location: index.php")
        ?>
    </body>
</html>