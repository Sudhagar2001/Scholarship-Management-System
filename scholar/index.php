<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];

    switch ($user_type) {
        case 'user':
            header("Location: user_login.php");
            exit();
        case 'officer':
            header("Location: officer_login.php");
            exit();
        case 'admin':
            header("Location: admin_login.php");
            exit();
        default:
            // Handle unexpected cases or errors
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        body {
            background-color: lightblue;
            margin: 0; /* Remove default body margin */
            font-family: Arial, sans-serif; /* Use a common sans-serif font */
        }

        header {
            background-color: lightpink;
            text-align: center;
            padding: 20px 0;
            font-size: 2em;
        }
h2{
    text-transform: uppercase;
}
        .image-container {
            display: flex;
            overflow: hidden;
            width: 100%;
            margin-top:30px;
            justify-content: center; /* Center the images horizontally */
            position: relative; /* Add positioning for the buttons */
        }

        .moving-image {
            width: 50%;
            height: 650px;
            display: none; /* Hide images by default */
        }

        button {
            padding: 10px 20px;
            background-color: lightblue;
            border: none;
            cursor: pointer;
            position: absolute;
            top: 50%; /* Center vertically */
            transform: translateY(-50%);
            font-size: 1.5em;
            color: #333; /* Dark text color */
        }

        button:first-child {
            left: 20px;
        }

        button:last-child {
            right: 20px;
        }

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
            font-size:50px;
            background-color:pink;
        }

        input[type="submit"] {
        padding: 10px 20px;
        background-color: lightblue;
        border: none;
        color:blue;
        cursor: pointer;
        font-size:50px;
        text-decoration: underline; /* Add underline */
    }
    .fas.fa-chevron-right {
    /* Your custom styles go here */
    color:blue; /* Example: change the color to green */
    font-size: 94px; /* Example: change the font size */
}
.fas.fa-chevron-left {
    /* Your custom styles go here */
    color:blue; /* Example: change the color to green */
    font-size: 94px; /* Example: change the font size */
}

    </style>
</head>
<body>
    <header>
    <h2>Scholarship Management System</h2>
    </header>
    <div class="image-container">
    <button onclick="showPreviousImage()"><i class="fas fa-chevron-left"></i></button>
         <img src="s1.jpg" alt="Scholarship Management System Image" class="moving-image">
        <img src="s2.jpg" alt="Scholarship Management System Image" class="moving-image">
        <img src="s3.jpg" alt="Scholarship Management System Image" class="moving-image">
        <!-- Add more images as needed -->
        <button onclick="showNextImage()"><i class="fas fa-chevron-right"></i></button>

    </div>

    
    

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="user_type">Select User Type:</label>
        <select name="user_type" id="user_type" required>
            <option value="user">User</option>
            <option value="officer">Officer</option>
            <option value="admin">Admin</option>
        </select>

        <input type="submit" value="Login">
    </form>

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
