<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="add_new_styles.css">
</head>
<body>
<?php include 'border.php'; ?>
    <div class="container">
        <h1>Add New Product</h1>
        <form action="#" method="post" enctype="multipart/form-data">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required>
            
            <label for="productDescription">Product Description:</label>
            <textarea id="productDescription" name="productDescription" required></textarea>
            
            <label for="productPrice">Product Price:</label>
            <input type="number" id="productPrice" name="productPrice" step="0.5" min="0" required>
            
            <!-- Select image to upload:
            <input type="file" name="image" id="image"> <br> -->
        

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    session_start();
    if(!isset($_SESSION['id'])) {

        header("Location: login.php");
        exit;
    } 
    $id = $_POST['productName'];
    $email = $_POST['productDescription'];
    $p_price = $_POST['productPrice'];
    $owner_id = $_SESSION['id'];
    
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
        // echo "Database 'Ecom' already exists";
    }

    

    $query = "Use Ecom";

    if ($conn -> query($query) === true)
    {
    // echo "Success";
    }
    else
    {
        die("Error");
    }

    $result = $conn->query("SHOW TABLES LIKE 'Products'");
    if ($result->num_rows == 0) {
        // Table does not exist, create it
        $sql = "CREATE TABLE Products (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            owner_id INT(6) UNSIGNED,
            p_name VARCHAR(30) NOT NULL,
            p_description VARCHAR(50) NOT NULL,
            p_price double NOT NULL,
            /* image LONGBLOB, */
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (owner_id) REFERENCES Users(id)
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table Products created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        // echo "Table Users already exists";
    }
    // echo $owner_id;
    $query = "INSERT INTO Products (owner_id,p_name, p_description, p_price) VALUES ('$owner_id', '$id', '$email', '$p_price')";
    if ($conn -> query($query) === true)
    {
        echo 'Successfully added';
    }
    else
    {
        echo 'something wrong';
        die("Error");
    }


    /* // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imgData = file_get_contents($image);
    } else {
        $imgData = null; // Handle the case where no image is uploaded
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Products (owner_id, p_name, p_description, p_price, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issds", $owner_id, $p_name, $p_des, $p_price, $imgData);

    if ($stmt->execute()) {
        echo 'Successfully added';
    } else {
        echo 'Something went wrong: ' . $stmt->error;
    }

    $stmt->close();

 */
    mysqli_close($conn);


}
?>
