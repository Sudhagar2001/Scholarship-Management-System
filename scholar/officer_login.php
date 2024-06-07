<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php");
    exit();
}

// Include the database connection file
require_once "connect_db.php";

// Process officer login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $officer_email = mysqli_real_escape_string($conn, $_POST['officer_email']);
    $officer_password = mysqli_real_escape_string($conn, $_POST['officer_password']);

    // Implement officer login logic here
    $sql = "SELECT * FROM officers WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $officer_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($officer_password, $row['password'])) {
                // Officer login successful
                $_SESSION['user_id'] = $row['officer_id'];
                header("Location: officer_dashboard.php");
                exit();
            } else {
                $login_error = "Invalid email or password.";
            }
        } else {
            $login_error = "Invalid email or password.";
        }

        mysqli_stmt_close($stmt);
    } else {
        die("Error in statement preparation: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Login</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5;
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

}


h2 {
    color: #333;
    text-align:center;
}

label {
    display: block;
    margin: 10px 0;
    color: black;
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
    font-size:25px;
}

p.error-message {
    color: red;
    margin-top: 10px;
    font-size:25px;
}

a {
    display: block;
    margin-top: 10px;
    text-align:center;
    color: #3498db;
    font-size:25px;
    text-decoration: none;
}

</style>
</head>
<body>
    <?php
    if (isset($login_error)) {
        echo "<p class='error-message'>$login_error</p>";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Officer Login</h2>
        <label for="officer_email">Email:</label>
        <input type="email" name="officer_email" required><br>

        <label for="officer_password">Password:</label>
        <input type="password" name="officer_password" required><br>

        <input type="submit" value="Login">
        <a href="index.php">Back To Home</a>
    </form>
</body>
</html>