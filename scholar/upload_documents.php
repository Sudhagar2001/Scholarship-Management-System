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

// Check if the main form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['main_form_submit'])) {
    // Retrieve form data
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    // ... (include other form fields as needed)

    // Check if the registration number is already in the database
    $checkRegNoSql = "SELECT * FROM scholarship_private WHERE reg_no = '$reg_no'";
    $checkRegNoResult = mysqli_query($conn, $checkRegNoSql);

    if (mysqli_num_rows($checkRegNoResult) > 0) {
        echo "Error: Registration number already exists! ReApply";
    } else {
        // Insert data into the database (this is a simplified example, adjust as needed)
        $sql = "INSERT INTO scholarship_private (student_name, date_of_birth, gender, reg_no, course, department, college, community, college_name, account_number, ifsc_code, bank_name, branch)
                VALUES ('$student_name', '$date_of_birth', '$gender', '$reg_no', '$course', '$department', '$college', '$community', '$college_name', '$account_number', '$ifsc_code', '$bank_name', '$branch')";

        if (mysqli_query($conn, $sql)) {
            $successMessage = "Form created successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Check if the document upload form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['document_upload_submit'])) {
    // Handle document uploads and store in the database
    // ...

    // Example: Insert into uploaded_documents table
    $form_id = 1; // Replace with the actual form_id
    $document_name = "Document 1"; // Replace with the actual document name
    $document_path = "path/to/document1.pdf"; // Replace with the actual document path

    $insertDocumentSql = "INSERT INTO uploaded_documents (form_id, document_name, document_path) 
                          VALUES ('$form_id', '$document_name', '$document_path')";

    if (mysqli_query($conn, $insertDocumentSql)) {
        echo "Document uploaded successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Private Scholarship Form</title>
    <style>
        /* Your existing styles here */
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <form id="main-form" action="index.php" method="post">
            <!-- Your existing form elements here -->

            <input type="hidden" name="main_form_submit" value="1">
            <input type="submit" value="Create Form">
            <a href="user_dashboard.php">Back To Home</a>
        </form>
    </div>

    <div class="sidebar">
        <h2>Progress</h2>
        <div id="progress-container">
            <div id="progress-bar"></div>
        </div>
    </div>

    <!-- Document upload form -->
    <div class="form-container">
        <form id="document-upload-form" action="index.php" method="post" enctype="multipart/form-data">
            <h2>Document Upload Form</h2>

            <!-- Add your document upload fields here -->
            <label for="document1">Document 1:</label>
            <input type="file" id="document1" name="document1" accept=".pdf, .doc, .docx" required><br>

            <label for="document2">Document 2:</label>
            <input type="file" id="document2" name="document2" accept=".pdf, .doc, .docx" required><br>

            <!-- Add a hidden input field to store the progress value -->
            <input type="hidden" name="document_upload_submit" value="1">
            <input type="hidden" id="upload-progress" value="0">

            <!-- Add submit button for document upload -->
            <input type="button" value="Upload Documents" onclick="uploadDocuments()">
        </form>
    </div>
</div>

<script>
    // AJAX submission for the main scholarship form
    $('#main-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
            },
            error: function(error) {
                alert('Error: ' + error.responseText);
            }
        });
    });

    // Your existing JavaScript functions here

</script>

</body>
</html>
