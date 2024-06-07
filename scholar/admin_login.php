<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// Include the database connection file
require_once "connect_db.php";

// Process admin login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);

    // Temporary default admin credentials
    $default_admin_email = "admin@example.com";
    $default_admin_password = password_hash("password", PASSWORD_DEFAULT); // Use password_hash() to securely hash passwords

    // Check if provided credentials match the default admin credentials
    if ($admin_email === $default_admin_email && password_verify($admin_password, $default_admin_password)) {
        // Admin login successful
        $_SESSION['user_id'] = 1; // You may set the admin user_id as needed
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $login_error = "Invalid email or password.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color:gray;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
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
}

h2 {
    color: #333;
    text-align:center;
    font-size:56px;

}

label {
    display: block;
    margin: 10px 0;
    color: #555;
    font-size:56px;
}

input {
    width: 100%;
    padding: 25px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
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
}

a:hover {
    text-decoration: underline;
}

        </style>
</head>
<body>
   
    <?php
    if (isset($login_error)) {
        echo "<p style='color: red;'>$login_error</p>";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Admin Login</h2>
        <label for="admin_email">Email:</label>
        <input type="email" name="admin_email" required><br>

        <label for="admin_password">Password:</label>
        <input type="password" name="admin_password" required><br>

        <input type="submit" value="Login">
        <a href="index.php">Back To Home</a>
    </form>
   
</body>
</html>
