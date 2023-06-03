<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

require_once 'database.php';

$sql = "SELECT * FROM listing";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=chrome" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car&Go</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
</head>
<body>
<header>
    <a href="index.php#home" class="logo"><img src="img/jeep.png" alt="" /></a>
    <div class="bx bx-menu" id="menu-icon"></div>
    <ul class="navbar">
        <li><a href="login_index.php#home">Home</a></li>
        <li><a href="login_index.php#ride">Ride</a></li>
        <li><a href="login_services.php">Services</a></li>
        <li><a href="Listing.php">Add Car</a></li>
        <li><a href="login_index.php#about">About</a></li>
    </ul>

    <div class="header-btn">
        <a href="logout.php" class="sign-up">Logout</a>
    </div>
</header>

<section class="services" id="services">
    <div class="heading">
        <span>Best services</span>
        <h1>
            Explore Our Top Deals <br />
            Top Rated Cars!
        </h1>
        <br />
    </div>

    <div class="filter-btns">
        <button type="button" class="filter-btn" id="all">All</button>
        <button type="button" class="filter-btn" id="sedan">Sedan</button>
        <button type="button" class="filter-btn" id="crossover">Crossover</button>
        <button type="button" class="filter-btn" id="hatchback">Hatchback</button>
        <button type="button" class="filter-btn" id="mpv">MPV</button>
        <button type="button" class="filter-btn" id="suv">SUV</button>
        <button type="button" class="filter-btn" id="van">Van</button>
        <button type="button" class="filter-btn" id="pick-up_truck">Pick-Up Truck</button>
    </div>

    <div class="filter-items">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="services-containers">
                <div class="filter-item all <?php echo $row["car_type"]; ?>">
                    <div class="box">
                        <div class="box-img">
                            <img src="Car_images/<?php echo $row["photo_car"]; ?>" alt="" />
                        </div>
                        <p><?php echo $row["year_car"]; ?></p>
                        <h3><?php echo $row["brand"]; ?></h3>
                        <h2>₱<?php echo $row["price"]; ?><span>/month</span></h2>
                        <a href="checkout.php" class="btn">Rent Now</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section class="newsletter">
    <h2>Subscribe To Newsletter</h2>
    <div class="box">
        <input class="text" placeholder="Enter your email.">
        <a href="#" class="btn">Subscribe</a>
    </div>
</section>

<div class="copyright">
    <p>@Car&Go All Right Reserved</p>
    <div class="social">
        <a href="#"><i class="bx bxl-facebook"></i></a>
        <a href="#"><i class="bx bxl-twitter"></i></a>
        <a href="#"><i class="bx bxl-instagram-alt"></i></a>
    </div>
</div>

<script src="filter.js"></script>
</body>
</html>
