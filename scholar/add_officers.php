<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Add Officers</title>
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

        .container {
            text-align: center;
            padding: 150px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size:25px;
        }

        h2 {
            color: #333;
            font-size: 30px;
        }

        form {
            max-width: 400px;
            margin: 20px 0;
            font-size:25px;
            text-align:left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size:25px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-size:25px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size:25px;
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
            font-size:25px;
        }

        th {
            background-color: #3498db;
            color: #fff;
            font-size:25px;
        }

        .error-message {
            color: red;
            font-size:25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Add Officers</h2>

        <?php
        // Include the database connection file
        require_once "connect_db.php";

        // Process officer addition form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $officer_email = mysqli_real_escape_string($conn, $_POST['officer_email']);
            $officer_password = password_hash($_POST['officer_password'], PASSWORD_DEFAULT);

            // Insert officer details into the database
            $insert_officer_sql = "INSERT INTO officers (email, password) VALUES ('$officer_email', '$officer_password')";
            $insert_officer_result = mysqli_query($conn, $insert_officer_sql);

            if ($insert_officer_result) {
                echo "<p style='color: green;'>Officer added successfully.</p>";
            } else {
                echo "<p class='error-message'>Error adding officer. Please try again.</p>";
            }
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="officer_email">Email:</label>
            <input type="email" name="officer_email" required><br>

            <label for="officer_password">Password:</label>
            <input type="password" name="officer_password" required><br>

            <button type="submit">Add Officer</button>
        </form>

        <?php
        // Query to get the list of officers
        $officer_query = "SELECT * FROM officers";
        $officer_result = mysqli_query($conn, $officer_query);

        if ($officer_result && mysqli_num_rows($officer_result) > 0) {
            echo "<table>";
            echo "<tr><th>Officer ID</th><th>Email</th></tr>";

            while ($row = mysqli_fetch_assoc($officer_result)) {
                echo "<tr>";
                echo "<td>{$row['officer_id']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p class='error-message'>No officers found.</p>";
        }

        mysqli_close($conn);
        ?>

        <br>
        <br>
        <a href="admin_dashboard.php">Back to Admin Dashboard</a>
    </div>
</body>
</html>
