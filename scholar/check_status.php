<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Scholarship Status</title>
    <style>
     body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}
form{
    margin-top:50px;
}
h2 {
    text-align: center;
    margin-top: 50px;
    color: #333;
    font-size: 26px;
}
a {
    text-align: center;
    margin-top: 50px;
    color: #333;
    font-size: 26px;
}
select {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 26px;
}

label {
    display: block;
    font-size: 26px;
    margin-bottom: 10px;
    color: #333;
}

input[type="text"] {
    width: calc(90% - 20px);
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 26px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

.status {
    margin-top: 20px;
    text-align: center;
    font-size: 28px;
    color: #333;
}

.back-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #333;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}
.container{
    
    width:60%;
    height: 500px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-left:350px;
    margin-top:50px;
    
}
    </style>
</head>
<body>
    <div class="container">
    <h2>Check Scholarship Status</h2>
    <form method="POST" action="">
        <label for="reg_no">Enter Registration Number:</label>
        <input type="text" id="reg_no" name="reg_no" required>
        <label for="scholarship_type">Select Scholarship Type:</label>
        <select id="scholarship_type" name="scholarship_type">
            <option value="state">State Scholarship</option>
            <option value="national">National Scholarship</option>
            <option value="private">Private Scholarship</option>
        </select>
        <br>
        <br>
        <button type="submit">Check Status</button>
        <br>
        <a href="user_dashboard.php" class="back-link">Back</a>
    </form>
</div>
    <?php
    // Include the database connection file
    require_once "connect_db.php";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reg_no']) && isset($_POST['scholarship_type'])) {
        $regNo = mysqli_real_escape_string($conn, $_POST['reg_no']);
        $scholarshipType = $_POST['scholarship_type'];

        // Query the database to fetch the status of the application based on the registration number and scholarship type
        $sql = "SELECT status FROM scholarship_$scholarshipType WHERE reg_no = '$regNo'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Check if any rows are returned
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $status = $row['status'];
                echo "<div class='status'>Status of your application: $status</div>";
            } else {
                echo "<div class='status'>No records found for the provided registration number and scholarship type.</div>";
            }
        } else {
            echo "Error fetching data: " . mysqli_error($conn);
        }
    }
    
    // Close the database connection
    mysqli_close($conn);
    ?>
   
</body>
</html>
