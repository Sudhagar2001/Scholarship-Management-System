<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Users</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
            padding: 150px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            font-size:30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            height: 50%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 38px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin View Users</h2>

        <?php
        // Include the database connection file
        require_once "connect_db.php";

        // Query to get the list of users
        $user_query = "SELECT * FROM users";
        $user_result = mysqli_query($conn, $user_query);

        if ($user_result && mysqli_num_rows($user_result) > 0) {
            echo "<table>";
            echo "<tr><th>User ID</th><th>Full Name</th><th>Email</th></tr>";

            while ($row = mysqli_fetch_assoc($user_result)) {
                echo "<tr>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['fullname']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p class='error-message'>No users found.</p>";
        }

        mysqli_close($conn);
        ?>
<br>
<br>
        <a href="admin_dashboard.php">Back to Admin Dashboard</a>
    </div>
</body>
</html>
