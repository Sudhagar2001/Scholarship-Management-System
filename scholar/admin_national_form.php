<?php
session_start();

// Check if the officer is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: officer_login.php");
    exit();
}

// Include the database connection file
require_once "connect_db.php";

$successMessage = '';
$errorMessages = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $community = mysqli_real_escape_string($conn, $_POST['community']);
    $college_name = mysqli_real_escape_string($conn, $_POST['college_name']);
    $account_number = mysqli_real_escape_string($conn, $_POST['account_number']);
    $ifsc_code = mysqli_real_escape_string($conn, $_POST['ifsc_code']);
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);

    // Process image uploads
    $uploadDir = "uploads/"; // Directory where images will be uploaded

    // Process Aadhar upload
    $aadhar = uploadFile($_FILES['aadhar'], $uploadDir);
    if ($aadhar === false) {
        $errorMessages[] = "Error uploading Aadhar file.";
    }

    // Process community upload
    $community_doc = uploadFile($_FILES['community'], $uploadDir);
    if ($community_doc === false) {
        $errorMessages[] = "Error uploading Community file.";
    }

    // Process marksheet upload
    $marksheet = uploadFile($_FILES['marksheet'], $uploadDir);
    if ($marksheet === false) {
        $errorMessages[] = "Error uploading Mark Sheet file.";
    }

    // Process income certificate upload
    $income_certificate = uploadFile($_FILES['income_certificate'], $uploadDir);
    if ($income_certificate === false) {
        $errorMessages[] = "Error uploading Income Certificate file.";
    }

    if (empty($errorMessages)) {
        // Insert data into the database
        $sql = "INSERT INTO scholarship_national (student_name, date_of_birth, gender, reg_no, course, department, college, community, college_name, account_number, ifsc_code, bank_name, branch, aadhar, community_doc, marksheet, income_certificate)
                VALUES ('$student_name', '$date_of_birth', '$gender', '$reg_no', '$course', '$department', '$college', '$community', '$college_name', '$account_number', '$ifsc_code', '$bank_name', '$branch', '$aadhar', '$community_doc', '$marksheet', '$income_certificate')";
    
        if (mysqli_query($conn, $sql)) {
            // Alert message using JavaScript
            echo '<script>alert("Form submitted successfully!");</script>';
            
            // Redirect to user_dashboard.php after a short delay
            header("refresh:3;url=user_dashboard.php");
            exit();
        } else {
            $errorMessages[] = "Error: " . mysqli_error($conn);
        }
    }}

// Function to handle file upload
function uploadFile($file, $uploadDir) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $filename = basename($file['name']);
        $targetFile = $uploadDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $filename;
        }
    }
    return false;
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Scholarship Form</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    font-size: 25px;
}

form {
    background-color: #fff;
    width: 50%;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    font-size: 25px;
}

h2 {
    color: #333;
    text-align: center;
}

label {
    display: block;
    margin: 10px 0;
    color: #555;
    font-size: 25px;
}

input,
select,
textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 25px;
}

input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    cursor: pointer;
    padding: 12px;
    border: none;
    border-radius: 4px;
    font-size: 25px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}

p.error-message {
    color: red;
    margin-top: 10px;
}

a {
    display: block;
    margin-top: 10px;
    text-align: center;
    color: #3498db;
    text-decoration: none;
    font-size: 25px;
}

a:hover {
    text-decoration: underline;
}

</style>
</head>
<body>
    <form action="admin_national_form.php" method="post" enctype="multipart/form-data">
        <h2>National Scholarship Form</h2>
        <label for="student_name">Student Name:</label>
        <input type="text" id="student_name" name="student_name" required><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br>

        <label for="reg_no">Registration Number:</label>
        <input type="text" id="reg_no" name="reg_no" required><br>

        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required><br>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required><br>

        <label for="college">College:</label>
        <input type="text" id="college" name="college" required><br>

        <label for="community">Community:</label>
        <input type="text" id="community" name="community" required><br>

        <label for="college_name">College Name:</label>
        <input type="text" id="college_name" name="college_name" required><br>

        <h2>Bank Details:</h2>
      
        <label for="account_number">Account Number:</label>
        <input type="text" id="account_number" name="account_number" required><br>

        <label for="ifsc_code">IFSC Code:</label>
        <input type="text" id="ifsc_code" name="ifsc_code" required><br>

        <label for="bank_name">Bank Name:</label>
        <input type="text" id="bank_name" name="bank_name" required><br>

        <label for="branch">Branch:</label>
        <input type="text" id="branch" name="branch" required><br>
       

        <h2>Upload Documents</h2>
        <label for="aadhar">Aadhar:</label>
        <input type="file" id="aadhar" name="aadhar" accept="image/*" required><br>

        <label for="community">Community:</label>
        <input type="file" id="community" name="community" accept="image/*" required><br>

        <label for="marksheet">Mark Sheet:</label>
        <input type="file" id="marksheet" name="marksheet" accept="image/*" required><br>

        <label for="income_certificate">Income Certificate:</label>
        <input type="file" id="income_certificate" name="income_certificate" accept="image/*" required><br>

        <input type="submit" value="Create Form">
        <a href="user_dashboard.php">Back To Home</a>

        <?php foreach ($errorMessages as $errorMessage): ?>
            <p class="error-message"><?= $errorMessage ?></p>
        <?php endforeach; ?>
        <?php if (!empty($successMessage)): ?>
            <script>
                // Display a success alert after a short delay
                setTimeout(function() {
                    alert('<?= $successMessage ?>');
                }, 2000);
            </script>
        <?php endif; ?>
    </form>
</body>
</html>
        