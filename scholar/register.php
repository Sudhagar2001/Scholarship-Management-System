<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php");
    exit();
}

// Include the database connection file
require_once "connect_db.php";

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_email_sql = "SELECT * FROM users WHERE email='$email'";
    $check_email_result = mysqli_query($conn, $check_email_sql);

    if (mysqli_num_rows($check_email_result) > 0) {
        echo "Error: Email already exists. Please choose a different email.";
    } else {
        $insert_user_sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

        if (mysqli_query($conn, $insert_user_sql)) {
            echo "Registration successful. You can now <a href='user_login.php'>login</a>.";
        } else {
            echo "Error: " . $insert_user_sql . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    font-size:25px;
}

form {
    background-color: #fff;
    width: 800px;
    padding: 80px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align:left;
    font-size:50px;
    background: repeating-linear-gradient(
        30deg,
        
        #86cef3 10px,
        #f3c796 40px
    );
    font-size:25px;
}

h2 {
    color: #333;
    text-align:center;
}

label {
    display: block;
    margin: 10px 0;
    color: #555;
    font-size:25px;
}

input {
    width: 100%;
    padding: 25px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size:25px;
}

input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    cursor: pointer;
    padding: 12px;
    border: none;
    border-radius: 4px;
    font-size: 56px;
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
    text-align:center;
    color: #3498db;
    text-decoration: none;
    font-size:25px;
}

a:hover {
    text-decoration: underline;
}

        </style>
</head>
<body>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>User Registration</h2>
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Register">

   
    If already register? Click To <a href="user_login.php">Login</a> 
    <a href="index.php">Back To Home</a>
    </form>
</body>
</html>
