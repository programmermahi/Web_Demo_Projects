
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="product_styles.css">
</head>
<body>
    <?php include 'border.php'; ?>
    <div class="container">
        <h1>Product List</h1>
        <?php
            $servername = "localhost";
            $db_username = "maruf22";
            $db_password = "123";
    
            // Create connection
            $conn = new mysqli($servername, $db_username, $db_password);
    
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
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
    
            // $sql = "SELECT id,u_name,email FROM Users WHERE email='$email' and u_password='$password'";
            // $ow_id = $_SESSION['id'];


            $sql = "SELECT p_name,p_description,p_price FROM Products"; //,image
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
            // output data of each row
            $res = array();
            while($row = $result->fetch_assoc()) {
                $id = $row['p_name'];
                $email = $row['p_description'];
                $p_price = $row['p_price'];
                /* $imgData = $row['image'];
                    
                    // Convert binary data to base64 encoded string
                    $imgBase64 = base64_encode($imgData);
                    
                    // Create image src
                    $imgSrc = 'data:image/jpeg;base64,' . $imgBase64;


 */

                //take below: <img src="' . $imgSrc . '" alt="' . $p_name . '">
                echo '<div class="product">
                <h2>'.$id.'</h2>
                <p>'.$email.'</p>
                <span>$'.$p_price.'</span>
            </div>';
            }
            } else {
            echo '<p>You have no Products to show!</p>';
            }
        ?>
        <!-- <div class="product">
            <img src="product1.jpg" alt="Product 1">
            <h2>Product 1</h2>
            <p>Description of Product 1</p>
            <span>$19.99</span>
        </div>
        <div class="product">
            <img src="product2.jpg" alt="Product 2">
            <h2>Product 2</h2>
            <p>Description of Product 2</p>
            <span>$29.99</span>
        </div> -->
        <!-- Add more product items here -->
    </div>
</body>
</html>

