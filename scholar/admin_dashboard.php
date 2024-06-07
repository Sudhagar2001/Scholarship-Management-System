<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.php");
    exit();
}
require_once "connect_db.php";
// Process officer addition form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $officer_email = mysqli_real_escape_string($conn, $_POST['officer_email']);
    $officer_password = password_hash($_POST['officer_password'], PASSWORD_DEFAULT); // Hash the password

    // Insert officer details into the database
    $sql = "INSERT INTO officers (email, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $officer_email, $officer_password);
        mysqli_stmt_execute($stmt);

        // Check if the insertion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $success_message = "Officer added successfully.";
        } else {
            $error_message = "Error adding officer. Please try again.";
        }

        mysqli_stmt_close($stmt);
    } else {
        die("Error in statement preparation: " . mysqli_error($conn));
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

#sidebar {
    width: 250px;
    height: 100vh;
    background-color: #333;
    color: #fff;
    float: left;
    padding-top: 20px;
}

#content {
    margin-left: 250px;
    padding: 20px;
}

header {
    font-size: 24px;
    padding: 20px;
    text-align: center;
    background-color: #3498db;
    color: #fff;
    margin: 0;
}

nav {
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
    margin-top:40px;
}

nav a {
    text-decoration: none;
    color: #3498db;
    font-weight: bold;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
    font-size:30px;
}

nav a:hover {
    background-color: #2980b9;
    color: #fff;
}

form {
    max-width: 400px;
    margin: 20px 0;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
    font-size:50px;
}

button {
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    cursor: pointer;
    margin-top: 20px;
    border-radius: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #4CAF50;
    color: #fff;
}

@media only screen and (max-width: 768px) {
    #sidebar {
        display: none;
    }

    #content {
        margin-left: 0;
    }
}

    </style>
</head>

<body>

    <!-- Sidebar -->
    <div id="sidebar">
    <nav><a href="admin_view_users.php">Users List</a></nav> 

    <nav><a href="add_officers.php">Add officers</a></nav>
        
    </div>

    <div id="content">
        <header>
            <h1>ADMIN PANEL</h1>
            <a href="logout.php">Logout</a>
        </header>
     
        

    
    </div>

   
</body>
</html>