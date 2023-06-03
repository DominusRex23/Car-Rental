<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=chrome" />
    <meta name="viewport" content="width=device-width" , initial-scale="1.0" />
    <title>Car&Go</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">

  </head>
  <header>
    <a href="index.php#home" class="logo"><img src="img/jeep.png" alt=" " /></a>
    <div class="bx bx-menu" id="menu-icon"></div>
    <ul class="navbar">
               <li><a href="login_index.php#home">Home</a></li>
               <li><a href="login_index.php#ride">Ride</a> </li>
               <li><a href="login_services.php">Services</a></li>
               <li><a href="Listing.php">Add Car</a></li>
               <li><a href="login_index.php#about">About</a></li>
    </ul>

    <div class="header-btn">
    <a href="logout.php" class="sign-up">Logout</a> 
    </div>
  </header>
  <div class="Listing-form-container">
  <?php
            require 'database.php';
            $errors = array();
            if (isset($_POST["upload"])){
                $email = $_POST["email"];
                $cartype = $_POST["car_type"];
                $brand = $_POST["car_brand"];
                $year = $_POST["year_car"];
                $license = $_FILES['license']['name'];
                $license_type = $_FILES['license']['type'];
                $license_size = $_FILES['license']['size'];
                $license_tem_loc = $_FILES['license']['tmp_name'];
                $license_store = "Car_papers/".$license;

                move_uploaded_file($license_tem_loc, $license_store);

                $registration = $_FILES['car_registration']['name'];
                $registration_type = $_FILES['car_registration']['type'];
                $registration_size = $_FILES['car_registration']['size'];
                $registration_tem_loc = $_FILES['car_registration']['tmp_name'];
                $registration_store = "Car_papers/".$registration;

                move_uploaded_file($registration_tem_loc, $registration_store);

                $photo = $_FILES['car_photo']['name'];
                $photo_type = $_FILES['car_photo']['type'];
                $photo_size = $_FILES['car_photo']['size'];
                $photo_tem_loc = $_FILES['car_photo']['tmp_name'];
                $photo_store = "Car_images/".$photo;

                move_uploaded_file($photo_tem_loc, $photo_store);

                $customers = $_POST["customer"];
                $price = $_POST["price"];

              
              
              
              
                
                    $sql = "INSERT INTO listing (email, car_type, brand, year_car, owner_license, owner_registration, photo_car, type_customer, price) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);

                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt,"sssissssi",$email, $cartype, $brand, $year, $license, $registration, $photo, $customers, $price);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Product Successfully Registered!</div>";
                    }else{
                        die("Something went wrong");
                    }
            }
            ?> 
  <form action= "Listing.php" method="post" enctype="multipart/form-data">
    <div class="form">
        <h5>Listing</h5>
        <input type="text" name="email" placeholder="Email" class="box">
        <label for="">Car Type</label>
        <input type="radio" name="car_type" value="sedan" required> SEDAN
        <input type="radio" name="car_type" value="crossover"> CROSSOVER
        <input type="radio" name="car_type" value="hatchback"> HATCHBACK
        <input type="radio" name="car_type" value="mpv"> MPV
        <input type="radio" name="car_type" value="suv"> SUV
        <input type="radio" name="car_type" value="van"> VAN
        <input type="radio" name="car_type" value="pick-up_truck" required> PICK-UP TRUCK
        <input type="text" name="car_brand" placeholder="Brand & Model" class="box" required>
        <input type="text" name="year_car" placeholder="Year" class="box" required>
        <label for="">License</label>
        <input type="file" name="license" id="license" accept=".pdf" value="" required>
        <label for="">Registration</label>
        <input type="file" name="car_registration" id="car_registration" accept=".pdf" value="" required> 
        <label for="">Car Photo</label>
        <input type="file" name="car_photo" id="car_photo" accept=".jpg, .png, .jpeg" value="" required>
        <label for="">Type of Customer/s</label>
        <input type="radio" name="customer" value="individuals" required> For Individuals
        <input type="radio" name="customer" value="corporates"> For Corporates
        <input type="radio" name="customer" value="individuals_corporates"> For Individuals/Corporates
        <input type="text" name="price" placeholder="Price" class="box" required>
        <input type="submit" value="List for rent" class="btn"  name="upload">

          </div>
          </div>
</html>