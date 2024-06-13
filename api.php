

<?php
    if($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        // $email = $_POST["email"];
        // $password = $_POST["password"];
        // $var = $_GET['name'];
        // echo $var;

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
        $sql = "SELECT id,u_name,email FROM Users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        $res = array();
        while($row = $result->fetch_assoc()) {
            // echo $row['email']."<br>";
            // setcookie("id", $row['id'], time() + (86400 * 30), "/");
            $arr = array(
                "name" => $row['u_name'],
                "email" => $row['email'],
                "id" => $row['id']
            );
            array_push($res,$arr);
            $json_data = json_encode($res);
            header('Content-Type: application/json');
            echo $json_data;
            // $_SESSION['id'] = $row['id'];
            
            // header("Location: home.php");
        }
        } else {
        echo '<p>No Such User</p>';
        }
    }
?>
