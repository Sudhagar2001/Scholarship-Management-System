
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Dashboard</title>
    <style>
       /* Reset some default styles for better consistency */
/* Reset some default styles for better consistency */
body, h1, h2, p, ul, li, table {
    margin: 0;
    padding: 0;
}

body {
    margin-left: 300px;
    margin-right: 20px;
    font-family: 'Arial', sans-serif;
     /* Added this line to make the background image cover the entire body */
}

#sidebar {
    background-color: #333;
    color: #fff;
    width: 280px;
    height: 100vh;
    padding-top: 20px;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto;
}
#sidebar h2 {
    text-align: center;
}

#sidebar ul {
    list-style: none;
    padding: 0;
}

#sidebar ul li {
    padding: 10px;
    border-bottom: 1px solid #555;
}

#sidebar ul li a {
    color: #fff;
    text-decoration: none;
    display: block;
}

#sidebar ul li a:hover {
    background-color: #555;
}

#content {
    margin-left: 250px;
    padding: 20px;
}

h2 {
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #333;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #555;
    color: #fff;
}

a {
    color:black;
    font-size:30px;
    padding:20px;
    text-decoration: none;
    margin-right: 10px;
}

a:hover {
    text-decoration: underline;
}

/* Responsive styles */
@media screen and (max-width: 768px) {
    #sidebar {
        width: 100%;
        position: static;
        height: auto;
    }

    #content {
        margin-left: 0;
    }
}
button{
    float:right;
    color:white;
    padding:20px;
    background-color:pink;
}
header{
    background-color:gray;
    font-size:30px;
    text-align:center;
    width:100%;
    height: 100px;
}

    </style>
</head>
<body>
    <header>
        <h1>OFFICER PANEL</h1>
</header>
    <!-- Sidebar -->
    <div id="sidebar">
        <h2>Scholarships</h2>
        <ul>
            <li><a href="?scholarship=admin_state_form.php">State Scholarship</a></li>
            <li><a href="?scholarship=admin_national_form.php">Central Scholarship</a></li>
            <li><a href="?scholarship=private.php">Private Scholarship</a></li>
           
        </ul>
    </div>
<br>
    <!-- Content -->
    <div id="content">
     


       <button> <a href="logout.php">Logout</a></button> <!-- A link to the logout page -->
    </div>
</body>
</html>
<br>
<br>
<?php
session_start();

// Check if the officer is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: officer_login.php");
    exit();
}

// Include the database connection file
require_once "connect_db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['scholarship']) && isset($_GET['action']) && isset($_GET['applicant_id'])) {
    $selectedScholarship = mysqli_real_escape_string($conn, $_GET['scholarship']);
    $action = mysqli_real_escape_string($conn, $_GET['action']);
    $applicantId = mysqli_real_escape_string($conn, $_GET['applicant_id']);

    // Update the status based on the action
    $status = ($action == 'approve') ? 'Approved' : 'Rejected';

    // Update the status in the respective table
    switch ($selectedScholarship) {
        case 'admin_state_form.php':
            $sql = "UPDATE scholarship_state SET status = '$status' WHERE id = $applicantId";
            break;
        case 'admin_national_form.php':
            $sql = "UPDATE scholarship_national SET status = '$status' WHERE id = $applicantId";
            break;
        case 'private.php':
            $sql = "UPDATE scholarship_private SET status = '$status' WHERE id = $applicantId";
            break;
        default:
            // Handle other cases or set a default action
            break;
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

// Fetch the data from the database based on the selected scholarship using prepared statements
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['scholarship'])) {
    $selectedScholarship = mysqli_real_escape_string($conn, $_GET['scholarship']);

    // Set the header and the table name
    switch ($selectedScholarship) {
        case 'admin_state_form.php':
            $tableHeader = "State Scholarship";
            $tableName = "scholarship_state";
            break;
        case 'admin_national_form.php':
            $tableHeader = "Central Scholarship";
            $tableName = "scholarship_national";
            break;
        case 'private.php':
            $tableHeader = "Private Scholarship";
            $tableName = "scholarship_private";
            break;
        default:
            // Handle other cases or set a default table
            break;
    }

    $sql = "SELECT * FROM $tableName";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Display the table of applicants
        echo "<h2>All Applicants for $tableHeader</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Student Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Registration Number</th>
                    <th>Course</th>
                    <th>Department</th>
                    <th>College</th>
                    <th>Community</th>
                    <th>College Name</th>
                    <th>Account Number</th>
                    <th>IFSC Code</th>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>Aadhar</th>
                    <th>Community</th>
                    <th>Marksheet</th>
                    <th>Income</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['student_name']}</td>
                    <td>{$row['date_of_birth']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['reg_no']}</td>
                    <td>{$row['course']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['college']}</td>
                    <td>{$row['community']}</td>
                    <td>{$row['college_name']}</td>
                    <td>{$row['account_number']}</td>
                    <td>{$row['ifsc_code']}</td>
                    <td>{$row['bank_name']}</td>
                    <td>{$row['branch']}</td>
                  
                    <td>{$row['aadhar']}</td>
                    <td>{$row['community_doc']}</td>
                    <td>{$row['marksheet']}</td>
                    <td>{$row['income_certificate']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='?scholarship=$selectedScholarship&action=approve&applicant_id={$row['id']}'>Approve</a>
                        <a href='?scholarship=$selectedScholarship&action=reject&applicant_id={$row['id']}'>Reject</a>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Error fetching data: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<?php
// Fetch the data from all scholarship tables for the total applications view
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['scholarship']) && $_GET['scholarship'] == 'totalapplications.php') {
    // Fetch data from scholarship_state
    $sqlState = "SELECT * FROM scholarship_state";
    $resultState = mysqli_query($conn, $sqlState);

    // Fetch data from scholarship_national
    $sqlNational = "SELECT * FROM scholarship_national";
    $resultNational = mysqli_query($conn, $sqlNational);

    // Fetch data from scholarship_private
    $sqlPrivate = "SELECT * FROM scholarship_private";
    $resultPrivate = mysqli_query($conn, $sqlPrivate);

    if ($resultState && $resultNational && $resultPrivate) {
        // Display the table of total applicants
        echo "<h2>Total Applications</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Student Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Registration Number</th>
                    <th>Course</th>
                    <th>Department</th>
                    <th>College</th>
                    <th>Community</th>
                    <th>College Name</th>
                    <th>Account Number</th>
                    <th>IFSC Code</th>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>Scholarship Type</th>
                </tr>";

        $totalApplications = 0; // Initialize total applications counter

        // Display data from scholarship_state
        while ($rowState = mysqli_fetch_assoc($resultState)) {
            displayTableRow($rowState, 'State Scholarship');
            $totalApplications++;
        }

        // Display data from scholarship_national
        while ($rowNational = mysqli_fetch_assoc($resultNational)) {
            displayTableRow($rowNational, 'Central Scholarship');
            $totalApplications++;
        }

        // Display data from scholarship_private
        while ($rowPrivate = mysqli_fetch_assoc($resultPrivate)) {
            displayTableRow($rowPrivate, 'Private Scholarship');
            $totalApplications++;
        }

        // Display the overall total
        echo "<tr>
                <td colspan='13' align='right'><strong>Overall Total:</strong></td>
                <td>{$totalApplications}</td>
              </tr>";

        echo "</table>";
    } else {
        echo "Error fetching data: " . mysqli_error($conn);
    }
}

// Function to display a table row
function displayTableRow($row, $scholarshipType) {
    echo "<tr>
            <td>{$row['student_name']}</td>
            <td>{$row['date_of_birth']}</td>
            <td>{$row['gender']}</td>
            <td>{$row['reg_no']}</td>
            <td>{$row['course']}</td>
            <td>{$row['department']}</td>
            <td>{$row['college']}</td>
            <td>{$row['community']}</td>
            <td>{$row['college_name']}</td>
            <td>{$row['account_number']}</td>
            <td>{$row['ifsc_code']}</td>
            <td>{$row['bank_name']}</td>
            <td>{$row['branch']}</td>
            <td>{$scholarshipType}</td>
        </tr>";
}

?>