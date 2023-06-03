<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="checkout.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<header>
    <a href="#" class="logo"><img src="img/jeep.png" alt=""></a>
    <div class="bx bx-menu" id="menu-icon"></div>
    <ul class="navbar">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#ride">Ride</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="index.php#reviews">Reviews</a></li>
        <li><a href="index.php#about">About</a></li>
    </ul>
    <div class="header-btn">
        <a href="logout.php" class="sign-up">Logout</a>
    </div>
</header>

<h2>Checkout Form</h2>

<div class="row" >

  <div class="col-75">
    <div class="container">
      <form action="/submit" method="POST">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3> 
            <div class="billing">
              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
              <input type="text" id="fname" name="firstname" placeholder="Juan Dela Cruz">
              <label for="email"><i class="fa fa-envelope"></i> Email</label>
              <input type="text" id="email" name="email" placeholder="JuanDelaCruz@gmail.com">
              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="adr" name="address" placeholder="PLM Intramuros">
              <label for="city"><i class="fa fa-institution"></i> City</label>
              <input type="text" id="city" name="city" placeholder="Manila">
              <div class="DATE">
                <label for="pick-up"></i>Pick Up Date</label>
                <input type="date" id="pick-up" name="pick-up" placeholder="date">
                <label for="return"></i> Return Date</label>
                <input type="date" id="return" name="return-date">
              </div>
              <div class="row">
                <div class="col-50">
                  <label for="Region">State</label>
                  <input type="text" id="Region" name="state" placeholder="NCR">
                </div>
                <div class="col-50">
                  <label for="zip">Zip</label>
                  <input type="number" id="zip" name="zip" placeholder="10001">
                </div>
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <button type="button" id="visa" onclick="toggleCardFields(true)">
                <img src="img/visa.png">
              </button>
              <button type="button" id="mastercard" onclick="toggleCardFields(true)">
                <img src="img/mastercard.jpg">
              </button>
              <button type="button" id="cash" onclick="toggleCardFields(false)">
                <img src="img/gcash.png">
              </button>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="Juan Dela Cruz">
            <label for="ccnum" id="ccnum-label">Credit/Debit card number</label>
            <input type="number" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="gcash">Mobile/Account Number</label>
            <input type="number" id="gcash" name="accnumber" placeholder="0912-215-2184">
            <label for="expmonth" id="expmonth-label">Exp Month/Year</label>
            <input type="month" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="cvv" id="cvv-label">CVV</label>
                <input type="number" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
        </div>
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>
</div>
    

<script src="checkout.js"></script>
</body>
</html>
