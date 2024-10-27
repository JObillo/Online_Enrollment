<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
</head>
<body>
    <header class="header">
        <h1>Online Enrollment for Monarch College</h1> <br>
    </header>

    <div class="form-body">
        <form action="form-connection.php" method="post">
            <h3>Basic Information</h3>
            <label for="last_name">Last name</label>
            <input type="text" id="last_name" name="last_name" required>
            
            <label for="first_name">First name</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="middle_name">Middle name</label>
            <input type="text" id="middle_name" name="middle_name"> <br> <br>

            <label for="birthdate">Birthdate</label>
            <input type="date" id="birthdate" name="birthdate" required> 

            <label for="gender">Gender</label>
            <input type="radio" id="male" name="gender" value="male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label> <br> <br>

            <label for="religion">Religion</label>
            <select id="religion" name="religion" required>
                <option value="catholic">Catholic</option>
                <option value="inc">INC</option>
                <option value="jw">JW</option>
                <option value="other">Other</option>
            </select>

            <label for="civil_status">Civil Status</label>
            <input type="radio" id="single" name="civil_status" value="single" required>
            <label for="single">Single</label>
            <input type="radio" id="married" name="civil_status" value="married">
            <label for="married">Married</label>
            <input type="radio" id="other" name="civil_status" value="other">
            <label for="other">Other</label>
            <br> <br>

            <h3>Contact Information</h3>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="student_phoneNo">Phone No</label>
            <input type="tel" id="student_phoneNo" name="student_phoneNo" required>
            <br> <br>

            <h3>Address</h3>
            <label for="barangay">Barangay</label>
            <input type="text" id="barangay" name="barangay" required>
            
            <label for="municipal">Municipal</label>
            <input type="text" id="municipal" name="municipal" required> <br> <br>
            
            <label for="province">Province</label>
            <input type="text" id="province" name="province" required>
            
            <label for="country">Country</label>
            <input type="text" id="country" name="country" required>

            <h3>Parents</h3>
            <label for="father_last_name">Father Last Name</label>
            <input type="text" id="father_last_name" name="father_last_name" placeholder="Lastname" required>
            
            <label for="father_first_name">Father First Name</label>
            <input type="text" id="father_first_name" name="father_first_name" placeholder="Firstname" required>
            
            <label for="father_middle_name">Father Middle Name</label>
            <input type="text" id="father_middle_name" name="father_middle_name" placeholder="Middlename"> <br> <br>

            <label for="father_occupation">Father Occupation</label>
            <input type="text" id="father_occupation" name="father_occupation" required> 
            
            <label for="father_phone_no">Father Phone No</label>
            <input type="tel" id="father_phone_no" name="father_phone_no" required>
            <br> <br>

            <label for="mother_last_name">Mother Last Name</label>
            <input type="text" id="mother_last_name" name="mother_last_name" placeholder="Lastname" required>
            
            <label for="mother_first_name">Mother First Name</label>
            <input type="text" id="mother_first_name" name="mother_first_name" placeholder="Firstname" required>
            
            <label for="mother_middle_name">Mother Middle Name</label>
            <input type="text" id="mother_middle_name" name="mother_middle_name" placeholder="Middlename"> <br> <br>

            <label for="mother_occupation">Mother Occupation</label>
            <input type="text" id="mother_occupation" name="mother_occupation" required> 
            
            <label for="mother_phone_no">Mother Phone No</label>
            <input type="tel" id="mother_phone_no" name="mother_phone_no" required>
            <br> <br>

            <h3>Education</h3>
            <label for="strand">Strand</label>
            <input type="text" id="strand" name="strand" placeholder="SHS Strand" required>
            
            <label for="year_graduated">Year Graduated</label>
            <input type="text" id="year_graduated" name="year_graduated" placeholder="Year Graduated" required>
            
            <label for="general_average">General Average</label>
            <input type="text" id="general_average" name="general_average" placeholder="General Average" required> <br> <br>

            <label for="transfer_last_school">Last School Attended</label>
            <input type="text" id="transfer_last_school" name="transfer_last_school" placeholder="Last School Attended" >
            
            <label for="transfer_last_year">Last School Year</label>
            <input type="text" id="transfer_last_year" name="transfer_last_year" placeholder="Last School Year" >
            
            <label for="transfer_course">Course</label>
            <input type="text" id="transfer_course" name="transfer_course" placeholder="Course" > <br> <br>

            <h3>Choose Course</h3>
            <label for="year_level">Year Level</label>
            <select id="year_level" name="year_level" required>
                <option value="1st">1st Year</option>
                <option value="2nd">2nd Year</option>
                <option value="3rd">3rd Year</option>
                <option value="4th">4th Year</option>
            </select> <br> <br>

            <label for="semester">Semester</label>
            <select id="semester" name="semester" required>
                <option value="fs">First Semester</option>
                <option value="ss">Second Semester</option>
            </select> <br> <br>

            <label for="course_name">Courses</label>
            <select id="course_name" name="course_name" required>
                <option value="it">Information Technology</option>
                <option value="cs">Computer Science</option>
            </select> <br> <br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
