<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once "connect_db.php";

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle error if user details are not found
    die("Error fetching user details");
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['scholarship'])) {
    $selectedScholarship = $_GET['scholarship'];

    // Redirect based on the selected scholarship
    header("Location: $selectedScholarship");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>User Dashboard</title>
  <style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

header {
    background-color: #3498db;
    color: #fff;
    padding: 20px;
    text-align: center;
}

h2 {
    text-transform:uppercase;
    color: #333;
    text-align: center;
    margin-top: 20px;
}

p {
    text-align: center;
    color:green;
}

a {
   
    font-size: 30px;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

nav {
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    margin-top: 20px;
    text-align: center;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center;
}

li {
    display: inline-block;
    margin-right: 20px;
}

li:last-child {
    margin-right: 0;
}

/* General form styles */
form {
    text-align: center;
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-size: 50px;
}

select {
    padding: 10px 18px;
    font-size: 50px;
    background-color: pink;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: lightblue;
    border: none;
    color: blue;
    cursor: pointer;
    font-size: 50px;
    text-decoration: underline; /* Add underline */
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #3498db;
    color: #fff;
}

/* Image container styles */
.image-container {
    display: flex;
    overflow: hidden;
    width: 100%;
    margin-top: 30px;
    justify-content: center;
    position: relative;
}

.moving-image {
    width: 50%;
    height: 650px;
    display: none;
}

button {
    padding: 10px 20px;
    background-color: lightblue;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.5em;
    color: #333;
}

button:first-child {
    left: 20px;
}

button:last-child {
    right: 20px;
}

.fas.fa-chevron-right,
.fas.fa-chevron-left {
    color: blue;
    font-size: 94px;
}
</style>
</head>

<body>

    <h2>Welcome, <?php echo $user['fullname']; ?>!</h2>
   
    <p ><a href="logout.php">Logout</a></p>
    <nav>
        <ul>
            <li><a href="admin_state_form.php">State Scholarship</a></li>
            <li><a href="admin_national_form.php">Centel Scholarship</a></li>
            <li><a href="private.php">Private Scholarship</a></li>
            <li><a href="check_status.php">Check Status</a></li>
        </ul>
    </nav>
    <div class="image-container">
    <button onclick="showPreviousImage()"><i class="fas fa-chevron-left"></i></button>
         <img src="s1.jpg" alt="Scholarship Management System Image" class="moving-image">
        <img src="s2.jpg" alt="Scholarship Management System Image" class="moving-image">
        <img src="s3.jpg" alt="Scholarship Management System Image" class="moving-image">
        <!-- Add more images as needed -->
        <button onclick="showNextImage()"><i class="fas fa-chevron-right"></i></button>

    </div>
    <nav>
    <form action="" method="get">
    <label for="scholarship-select">Select Scholarship from the List:</label>
    <select id="scholarship-select" name="scholarship">
        <option value="#" disabled selected>Please Select</option>
        <option value="admin_state_form.php">State Scholarship</option>
        <option value="admin_national_form.php">Centel Scholarship</option>
        <option value="private.php">Private Scholarship</option>
    </select>
    <input type="submit" value="Go">
</form>
    </nav>

    <script>
    let currentImageIndex = 0;
    const images = document.querySelectorAll('.moving-image');

    // Display the first image by default
    images[currentImageIndex].style.display = 'block';

    function showNextImage() {
        images[currentImageIndex].style.display = 'none';
        currentImageIndex = (currentImageIndex + 1) % images.length;
        images[currentImageIndex].style.display = 'block';
    }

    function showPreviousImage() {
        images[currentImageIndex].style.display = 'none';
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        images[currentImageIndex].style.display = 'block';
    }
</script>
</body>
</html>
