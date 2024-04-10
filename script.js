/* Define Global Variables */
var alertMessage = "Hi, please make sure to:\n";
var missingFields=[];
var fieldMap = {
    'student':"select a Student from the drop-down list",
    'course':"select a course in the drop-down list",
    'grade':"input a valid Grade form 0 to 100"
}

var student = "";
var course = "";
var grade = "";


function formFieldsFull() {
    /* I check if any field is empty, and if it is I save it in
     the missingField array*/
    if (student === "") {
        missingFields.push("student");
    }
    if (course === "") {
        missingFields.push("course");
    }
    if (grade === "" || parseInt(grade) < 0 || parseInt(grade) > 100) {
        missingFields.push("grade");
    }
    //If the array is empty, then everything is ok, so I return ture
    if (missingFields.length === 0) {
        //console.log("The fields are full - true");
        return true
    } else {
        return false
    }
}



function checkFields() {
    student = document.getElementById("student").value;
    course = document.getElementById("course").value;
    grade = document.getElementById("grade").value;
    //console.log("The student is " + student)
    //console.log("The course is " + course)
    //console.log("The grade is " + grade)

    var isFull = formFieldsFull() // I need to call it to get the missingFields
                                  // array before the conditional.

    if (isFull) {
        return true;
    } else {
        //console.log("I AM IN THE ALERT - FIELDS EMPTY");
        //console.log("THE MISSINGFIELDS ARE: " + missingFields)
        while (missingFields.length > 0) {
            var value = missingFields.shift() //Removes first element similar to pop()
            alertMessage += "*" + fieldMap[value] + "\n";
            //console.log(value + " is the value and " + fieldMap[value] + " is the message")
        }
        alert(alertMessage);
        alertMessage = "Hi, please make sure to:\n"; //Reset message in case the submit button is hit again.
        return false;
    }
}