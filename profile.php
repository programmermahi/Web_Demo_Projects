
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <?php include 'border.php'; ?>
    <div class="container">
        <h1>User Profile</h1>
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
    
            // $ow_id = $_SESSION['id'];

            
            $sql = "SELECT id,u_name,email FROM Users where id = '$ow_id'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
            // output data of each row
            $res = array();
            while($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $email = $row['email'];
                $name = $row['u_name'];
                $imgData = $row['image'];
                    
                    // Convert binary data to base64 encoded string
                    $imgBase64 = base64_encode($imgData);
                    
                    // Create image src
                    $imgSrc = 'data:image/jpeg;base64,' . $imgBase64;




                //take below: 
                echo '<div class="product">
                <img src="' . $imgSrc . '">
                <h2>User name: '.$name.'</h2>
                <h2> ID: '.$id.'</h2>
                <p> Email: '.$email.'</p>
                
            </div>';
            }
            } else {
            /* echo '<p>You have no Products to show!</p>'; */
            }
        ?>
        
    </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$userid = $_SESSION['id'];

$servername = "localhost";
$db_username = "maruf22";
$db_password = "123";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "USE Ecom";
if ($conn->query($query) === true) {
    // echo "Success";
} else {
    die("Error");
}

$sql = "SELECT u_name, email, image FROM Users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['u_name'];
    $email = $row['email'];
    $imgBase64 = base64_encode($row['image']);
    $imgSrc = 'data:image/jpeg;base64,' . $imgBase64;
} else {
    echo "No user found.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
</head>
<body>
    <h1>User Info</h1>
    <div class="user-info">
        <img src="<?php echo $imgSrc; ?>" alt="<?php echo $username; ?>" />
        <p>Username: <?php echo $username; ?></p>
        <p>Email: <?php echo $email; ?></p>
    </div>
</body>
</html>
