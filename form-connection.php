<?php
// Define variables using correct POST keys
$last_name = $_POST['last_name'] ?? null;
$first_name = $_POST['first_name'] ?? null;
$middle_name = $_POST['middle_name'] ?? null;
$birthdate = $_POST['birthdate'] ?? null;
$gender = $_POST['gender'] ?? null;
$religion = $_POST['religion'] ?? null;
$civil_status = $_POST['civil_status'] ?? null;
$email = $_POST['email'] ?? null;
$student_phoneNo = $_POST['student_phoneNo'] ?? null;  // Now in students table
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
$strand = $_POST['strand'] ?? null;
$year_graduated = $_POST['year_graduated'] ?? null;
$general_average = $_POST['general_average'] ?? null;
$year_level = $_POST['year_level'] ?? null; // Move year_level here
$semester = $_POST['semester'] ?? null; // Move semester here
$course_name = $_POST['course_name'] ?? null; // Move course_name here

// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = "2024"; // Your database password
$dbname = "enrollment_form"; // Your database name

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
    $student_id = $conn->insert_id; // Assuming you have an AUTO_INCREMENT primary key in students table

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
    $stmt4 = $conn->prepare("INSERT INTO education (student_id, strand, year_graduated, general_average) VALUES (?, ?, ?, ?)");
    if (!$stmt4) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt4->bind_param("isss", $student_id, $strand, $year_graduated, $general_average);
    $stmt4->execute();

    // Insert into courseenrollment table
    $stmt5 = $conn->prepare("INSERT INTO courseenrollment (student_id, year_level, semester, course_name) VALUES (?, ?, ?, ?)");
    if (!$stmt5) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt5->bind_param("isss", $student_id, $year_level, $semester, $course_name);
    $stmt5->execute();

    // Commit the transaction
    $conn->commit();

    echo "Registration Successful";
} catch (Exception $e) {
    // Rollback the transaction in case of error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
} finally {
    // Close statements and connection, checking if they are defined
    if (isset($stmt1)) $stmt1->close();
    if (isset($stmt2)) $stmt2->close();
    if (isset($stmt3)) $stmt3->close();
    if (isset($stmt4)) $stmt4->close();
    if (isset($stmt5)) $stmt5->close();
    $conn->close();
}
?>
