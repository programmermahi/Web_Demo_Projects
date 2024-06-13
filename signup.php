<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup_styles.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="#" method="post" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="userImage">Profile Image:</label>
            <input type="file" id="userImage" name="userImage" required>
            
            <button type="submit">Sign Up</button>
            <p style="color: red;">Already have an account? <a href="login.php">Sign In</a></p>
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Handle the file upload
    if (isset($_FILES['userImage']) && $_FILES['userImage']['error'] == 0) {
        $image = $_FILES['userImage']['tmp_name'];
        $imgData = file_get_contents($image);
    } else {
        $imgData = null; // Handle the case where no image is uploaded
    }

    $servername = "localhost";
    $db_username = "maruf22";
    $db_password = "123";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SHOW DATABASES LIKE 'Ecom'");
    if ($result->num_rows == 0) {
        // Database does not exist, create it
        $sql = "CREATE DATABASE Ecom";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }
    } else {
        echo "Database 'Ecom' already exists";
    }

    $query = "USE Ecom";

    if ($conn->query($query) === true) {
        echo "Success";
    } else {
        die("Error");
    }

    $result = $conn->query("SHOW TABLES LIKE 'Users'");
    if ($result->num_rows == 0) {
        // Table does not exist, create it
        $sql = "CREATE TABLE Users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            u_name VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            u_password VARCHAR(30) NOT NULL,
            image LONGBLOB,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table Users created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        echo "Table Users already exists";
    }

    $stmt = $conn->prepare("INSERT INTO Users (u_name, email, u_password, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $imgData);

    if ($stmt->execute()) {
        include 'redirect.php';
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    mysqli_close($conn);
}
?>
