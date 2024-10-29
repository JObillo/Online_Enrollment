<?php
// Initialize variables for form data
$last_name = $first_name = $middle_name = $birthdate = $gender = $religion = $civil_status = $email = "";
$student_phoneNo = $barangay = $municipal = $province = $country = "";
$father_last_name = $father_first_name = $father_middle_name = $father_occupation = $father_phone_no = "";
$mother_last_name = $mother_first_name = $mother_middle_name = $mother_occupation = $mother_phone_no = "";
$last_school_attended = $strand = $year_graduated = $general_average = "";
$transfer_last_school = $transfer_last_year = $transfer_course = "";
$year_level = $semester = $course_name = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $last_name = $_POST['last_name'] ?? null;
    $first_name = $_POST['first_name'] ?? null;
    $middle_name = $_POST['middle_name'] ?? null;
    $birthdate = $_POST['birthdate'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $religion = $_POST['religion'] ?? null;
    $civil_status = $_POST['civil_status'] ?? null;
    $email = $_POST['email'] ?? null;
    $student_phoneNo = $_POST['student_phoneNo'] ?? null;
    $barangay = $_POST['barangay'] ?? null;
    $municipal = $_POST['municipal'] ?? null;
    $province = $_POST['province'] ?? null;
    $country = $_POST['country'] ?? null;
    $father_last_name = $_POST['father_last_name'] ?? null;
    $father_first_name = $_POST['father_first_name'] ?? null;
    $father_middle_name = $_POST['father_middle_name'] ?? null;
    $father_occupation = $_POST['father_occupation'] ?? null;
    $father_phone_no = $_POST['father_phone_no'] ?? null;
    $mother_last_name = $_POST['mother_last_name'] ?? null;
    $mother_first_name = $_POST['mother_first_name'] ?? null;
    $mother_middle_name = $_POST['mother_middle_name'] ?? null;
    $mother_occupation = $_POST['mother_occupation'] ?? null;
    $mother_phone_no = $_POST['mother_phone_no'] ?? null;
    $last_school_attended = $_POST['last_school_attended'] ?? null;
    $strand = $_POST['strand'] ?? null;
    $year_graduated = $_POST['year_graduated'] ?? null;
    $general_average = $_POST['general_average'] ?? null;
    $transfer_last_school = $_POST['transfer_last_school'] ?? null;
    $transfer_last_year = $_POST['transfer_last_year'] ?? null;
    $transfer_course = $_POST['transfer_course'] ?? null;
    $year_level = $_POST['year_level'] ?? null;
    $semester = $_POST['semester'] ?? null;
    $course_name = $_POST['course_name'] ?? null;

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "2024";
    $dbname = "enrollment_form";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Start a transaction
        $conn->begin_transaction();

        // Insert into students table
        $stmt1 = $conn->prepare("INSERT INTO students (last_name, first_name, middle_name, birthdate, gender, religion, civil_status, email, student_phoneNo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt1) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt1->bind_param("sssssssss", $last_name, $first_name, $middle_name, $birthdate, $gender, $religion, $civil_status, $email, $student_phoneNo);
        $stmt1->execute();

        // Get the last inserted student ID
        $student_id = $conn->insert_id;

        // Insert into address table
        $stmt2 = $conn->prepare("INSERT INTO address (student_id, barangay, municipal, province, country) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt2) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt2->bind_param("issss", $student_id, $barangay, $municipal, $province, $country);
        $stmt2->execute();

        // Insert into parents table
        $stmt3 = $conn->prepare("INSERT INTO parents (student_id, father_last_name, father_first_name, father_middle_name, father_occupation, father_phone_no, mother_last_name, mother_first_name, mother_middle_name, mother_occupation, mother_phone_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt3) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt3->bind_param("issssssssss", $student_id, $father_last_name, $father_first_name, $father_middle_name, $father_occupation, $father_phone_no, $mother_last_name, $mother_first_name, $mother_middle_name, $mother_occupation, $mother_phone_no);
        $stmt3->execute();

        // Insert into education table
        $stmt4 = $conn->prepare("INSERT INTO education (student_id, last_school_attended, strand, year_graduated, general_average, transfer_last_school, transfer_last_year, transfer_course) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt4) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt4->bind_param("isssssss", $student_id, $last_school_attended, $strand, $year_graduated, $general_average, $transfer_last_school, $transfer_last_year, $transfer_course);
        $stmt4->execute();

        // Insert into course enrollment table
        $stmt5 = $conn->prepare("INSERT INTO courseenrollment (student_id, year_level, semester, course_name) VALUES (?, ?, ?, ?)");
        if (!$stmt5) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt5->bind_param("isss", $student_id, $year_level, $semester, $course_name);
        $stmt5->execute();

        // Commit the transaction
        $conn->commit();

        // Successful registration message
        $successMessage = "Registration Successful";
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        $errorMessage = "Error: " . $e->getMessage();
    } finally {
        // Close statements and connection
        if (isset($stmt1)) $stmt1->close();
        if (isset($stmt2)) $stmt2->close();
        if (isset($stmt3)) $stmt3->close();
        if (isset($stmt4)) $stmt4->close();
        if (isset($stmt5)) $stmt5->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
</head>
<body>
    <header class="header">
        <h1>Online Enrollment for Monarch College kalbo</h1>
    </header>

    <div class="form-body">
        <form action="" method="post">
            <h3>Basic Information</h3>
            <label for="last_name">Last name</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>

            <label for="first_name">First name</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>

            <label for="middle_name">Middle name</label>
            <input type="text" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($middle_name); ?>"><br><br>

            <label for="birthdate">Birthdate</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required>

            <label>Gender</label>
            <input type="radio" id="male" name="gender" value="male" <?php if($gender == 'male') echo 'checked'; ?> required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" <?php if($gender == 'female') echo 'checked'; ?>>
            <label for="female">Female</label><br><br>

            <label for="religion">Religion</label>
            <select id="religion" name="religion" required>
                <option value="catholic" <?php if($religion == 'catholic') echo 'selected'; ?>>Catholic</option>
                <option value="inc" <?php if($religion == 'inc') echo 'selected'; ?>>INC</option>
                <option value="jw" <?php if($religion == 'jw') echo 'selected'; ?>>JW</option>
                <option value="other" <?php if($religion == 'other') echo 'selected'; ?>>Other</option>
            </select>

            <label>Civil Status</label>
            <input type="radio" id="single" name="civil_status" value="single" <?php if($civil_status == 'single') echo 'checked'; ?> required>
            <label for="single">Single</label>
            <input type="radio" id="married" name="civil_status" value="married" <?php if($civil_status == 'married') echo 'checked'; ?>>
            <label for="married">Married</label>
            <input type="radio" id="other" name="civil_status" value="other" <?php if($civil_status == 'other') echo 'checked'; ?>>
            <label for="other">Other</label><br><br>

            <h3>Contact Information</h3>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="student_phoneNo">Phone No</label>
            <input type="tel" id="student_phoneNo" name="student_phoneNo" value="<?php echo htmlspecialchars($student_phoneNo); ?>" required pattern="[0-9]{10}"><br><br>

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
            <h4>Senior Highschool</h4>
            <label for="last_school_attended"></label>
            <input type="text" id="last_school_attended" name="last_school_attended" placeholder="Last School Attended" >

            <label for="strand"></label>
            <input type="text" id="strand" name="strand" placeholder="SHS Strand" required> <br> <br>
            
            <label for="year_graduated"></label>
            <input type="text" id="year_graduated" name="year_graduated" placeholder="Year Graduated" required>
            
            <label for="general_average"></label>
            <input type="text" id="general_average" name="general_average" placeholder="General Average" required>
             <br>
             
             <h4>Transferee</h4>
             <label for="transfer_last_school"></label>
             <input type="text" id="transfer_last_school" name="transfer_last_school" placeholder="Last School Attended">

             <label for="transfer_last_year"></label>
             <input type="text" id="transfer_last_year" name="transfer_last_year" placeholder="Last School Year">
            <br> <br>
             <label for="transfer_course"></label>
             <input type="text" id="transfer_course" name="transfer_course" placeholder="Course">
             

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
            
            <button type="submit">Submit</button>
        </form>

        <?php
        // Display success or error message
        if (isset($successMessage)) {
            echo "<p style='color: green;'>$successMessage</p>";
        }
        if (isset($errorMessage)) {
            echo "<p style='color: red;'>$errorMessage</p>";
        }
        ?>
    </div>
</body>
</html>

