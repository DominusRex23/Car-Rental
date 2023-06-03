    <?php
        session_start();
        require 'database.php';

        // Check if the user is already logged in
        if (isset($_SESSION["id"])) {
            header("Location: login_index.php");
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


            
        </head>     
        <body>
            <header>
                <a href="index.php#home" class="logo"><img src="img/jeep.png" alt=" "></a>
                <div class="bx bx-menu" id="menu-icon"></div>
                <ul class="navbar">
                <li><a href="index.php">Home</a></li>
                </ul>
                

            </header>

            <div class="login-form-container">
            <?php
                
                if(isset($_POST["login"])){
                $email = $_POST["email"];
                $password = $_POST["password"];

                $result = mysqli_query($conn, "SELECT * FROM cargo WHERE email = '$email'");
                $row = mysqli_fetch_assoc($result);
                if(mysqli_num_rows($result) > 0){
                if($password == $row['password']){
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
                header("Location: login_index.php");
        }
        
                else{
                echo"<div class='alert alert-success'>Wrong Password</div>";
        }
    }

                else if(empty($email) OR empty($password)){
                echo"<div class='alert alert-success'>All fields are required</div>";
    }
                else{
                    echo"<div class='alert alert-success'>User Not Registered</div>";
                }
    }
    ?>

        
        <form action="login.php" method="post">
        <h3>Login</h3>
            <input type="email" name="email" placeholder="Email" class="box">
            <input type="password" name="password" placeholder="Password" class="box">
            <span class="checkbox">
                <input type="checkbox" id="check"/>
                <label for="check">Remember me</label>
            </span>
            <p><a href="forgot.php">Forgot password?</a></p>
            <input type="submit" name="login" value="Log In" class="btn">
            <div class="login_signup">
                Don't have an account?<a href="signup.php" id="signup">  Sign Up</a>
            </div>
        </form>
    </div>


            
        </body>
    </html>
