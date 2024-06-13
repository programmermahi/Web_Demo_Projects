
<?php

    session_start();
    if(!isset($_SESSION['id'])) {

      header("Location: login.php");
      exit;
    } 
    else {
      
    } 
        
    
    
    // if($_SERVER['REQUEST_METHOD'] === 'GET')
    // {
        
      // if(!isset($_COOKIE['id'])) {
        
      //   header("Location: login.php");
      //   exit;
      // } else {
        
      // }
    // }
    // if($_SERVER['REQUEST_METHOD'] === 'POST')
    // {
    //     $name = $_POST["name"];
    //     $email = $_POST["email"];
    //     $message = $_POST["message"];
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple E-Commerce Website</title>
  <link rel="stylesheet" href="mystyle.css">
</head>
<body>
  
  <?php include 'border.php'; ?>
    <br>
    <br>
  <section class="controls">
    <div id="controls">
        <input type="text" id="search" placeholder="Search Product      🔍">
        <button onclick="sortByName()">Sort by Name &#8597;</button>
        <br>
    </div>
    </section>
    <br>
    <br>

  <main>
    
    <section class="product">
      <img src="product1.jpg" alt="Product 1">
      <h2>Laptop</h2>
      <p>$20.00</p>
      <button>Add to Cart</button>
    </section>
    <section class="product">
      <img src="product2.jpg" alt="Product 2">
      <h2>Mobile</h2>
      <p>$25.00</p>
      <button>Add to Cart</button>
    </section>
    <section class="product">
      <img src="product1.jpg" alt="Product 3">
      <h2>Laptop</h2>
      <p>$20.00</p>
      <button>Add to Cart</button>
    </section>
    <section class="product">
      <img src="product2.jpg" alt="Product 4">
      <h2>Mobile</h2>
      <p>$25.00</p>
      <button>Add to Cart</button>
    </section>
    <!-- More products can be added here -->
  </main>

  <footer>
    <p>&copy; 2024 Simple E-Commerce. All rights reserved.</p>
  </footer>
</body>
</html>
