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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=chrome">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>Car&Go</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" type="text/css" href="fontawesome-free-6.4.0-web/css/all.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        
    </head>     
    <body>
        <header>
            <a href="login_index.php" class="logo"><img src="img/jeep.png" alt=" "></a>
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

<!--Home Page-->

        <section class="home" id="home">
            <div class="text">
                <h1><span>Looking</span> to <br> Rent a <span>car</span>?</h1>
            </div>
            
            <div class="form-container">
            <form autocomplete="off" action="login_services.php">
                <div class="input-box">
                    <span>Location</span>
                    <input type="search" name="cities" id="myInput" placeholder="Search Places">
                </div>
                <div class="input-box">
                    <span>Pick-Up Date</span>
                    <input type="date" name="" id="">
                </div>
                <div class="input-box">
                    <span>Return Date</span>
                    <input type="date" name="" id="">
                </div>
                <input type="submit" name="" id="" class="btn">                 
            </form>
             </div>
             <script src="autocomplete.js"> </script>
        </section>

<!--Our Ride-->

        <section class="ride" id="ride">
                </div>
            <div class="heading">
                <span>How It Works?</span><h1>Rent With 3 Easy Steps</h1>
            </div>
        <div class="ride-container">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <div class="box">
                <i class='bx bxs-map bx-tada' ></i>
                <h2>Choose A Location</h2>
                <p>To choose a rental location, please enter your desired city or airport in the search bar and select from the available options that appear. Note that the location search is limited to 200 characters.</p>
                </p>
            </div>

            <div class="box">
                <i class='bx bxs-calendar-check bx-tada' ></i>
                <h2>Pick-Up Date</h2>
                <p>Select the pick-up date for your rental car. Our system will show you available cars for the dates you have selected. Please note that the pick-up date must be at least 24 hours in advance and cannot exceed 30 days from today's date. </p>
            </div>

            <div class="box">
                <i class='bx bxs-calendar-star bx-tada' ></i>                
                <h2>Book A Car</h2>
                <p>Once you have selected your preferred pickup location and date, you can now browse through our range of available rental cars and choose the one that best suits your needs. Select the vehicle that you would like to rent, and provide any additional details such as insurance, fuel options, and any special requests..</p>
            </div>
        </div>
        </section>

<!--MEET THE TEAM-->

<section class="about" id="about">
<div class="heading">
      <span> ABOUT US</span>
      <h1>Meet The Team</h1>
    </div>
   <div class="slideshow-container">
<div class="mySlides fade">
  <img src="img/kobe.jpg" style="width:500px">
  <div class="caption">Dee, Sean John Kobe B. - Developer</div>
</div>

<div class="mySlides fade">
  <img src="img/rex.jpg" style="width:500px">
  <div class="caption">Nono, Ricardo - Developer</div>
</div>

<div class="mySlides fade">
  <img src="img/jc.jpg" style="width:500px">
  <div class="caption">Palabay, Joven Carl B. - Project Manager/Technical Writer
</div>
</div>

<div class="mySlides fade">
  <img src="img/marcus.jpg" style="width:500px">
  <div class="caption">Florida, Marcus Aaric C. - Quality Assurance Tester/Technical Writer
</div>
</div>

<div class="mySlides fade">
  <img src="img/dejuan.png" style="width:500px">
  <div class="caption">De Juan, Lord Welchie P. - System Analyst/Quality Assurance Tester
</div>
</div>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
</div>
<script>let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
  </script>
           <div class="about-text">
            <span> Meet The 5</span>
            <p> </p>
            <a href="#" class="btn">Learn More</a>
           </div>
</section>
   
<!--Newsletter-->

<section class="newsletter">
    <h2>Subscribe To Newsletter</h2>
    <div class="box">
        <input class="text" placeholder="Enter your email.">
        <a href="#" class="btn">Subscribe</a>
    </div>
</section>

<!--Copyright-->

<div class="copyright">
    <p>@Car&Go All Right Reserved</p>
    <div class="social">
        <a href="#"><i class='bx bxl-facebook'></i></a>
        <a href="#"><i class='bx bxl-twitter' ></i></a>
        <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
    </div>

</div>
   
<!--LINK TO JS-->

        <script src="menu.js"></script> 

    </body>
</html> 