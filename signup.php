<?php
session_start();

if (isset($_SESSION["user"])) {
   header("Location: index.php#home");
}

$errors = array();
$firstname = "";
$lastname = "";
$username = "";
$email = "";
$password = "";
$passwordRepeat = "";
$address = "";

if (isset($_POST["signup"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["retype_password"];
    $address = $_POST["address"];

    if ($password !== $passwordRepeat) {
        array_push($errors, "Password does not match");
    } else {
        // Validate other fields
        if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordRepeat) || empty($address)) {
            array_push($errors, "All fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }
        if (!preg_match("/[0-9]/", $password)) {
            array_push($errors, "Password should contain at least one (1) number");
        }
        if (!preg_match("/[A-Z]/", $password)) {
            array_push($errors, "Password should contain at least one (1) uppercase letter");
        }
        if (!preg_match("/[a-z]/", $password)) {
            array_push($errors, "Password should contain at least one (1) lowercase letter");
        }
        if (!preg_match("/[_\-\+\=\!\@\%\*\&\”\:\.\/\#\$]/", $password)) {
            array_push($errors, "Password should contain at least one (1) special character");
        }
        if (preg_match("/\s/", $password)) {
            array_push($errors, "Password should not contain any spaces");
        }

        if (count($errors) === 0) {
            require_once "database.php";
            $sql = "SELECT * FROM cargo WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email already exists!");
            } else {
                $sql = "INSERT INTO cargo (first_name, last_name, username, email, password, address) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $username, $email, $password, $address);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    // Clear the form values after successful registration
                    $firstname = "";
                    $lastname = "";
                    $username = "";
                    $email = "";
                    $password = "";
                    $passwordRepeat = "";
                    $address = "";
                } else {
                    die("Something went wrong");
                }
            }
        }
    }
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

<div class="signup-form-container">
    <?php
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
    ?>
    <form action="signup.php" method="post">
        <div class="form">
            <h5>Sign Up</h5>
            <input type="text" name="firstname" placeholder="First Name" class="box" value="<?php echo $firstname; ?>">
            <input type="text" name="lastname" placeholder="Last Name" class="box" value="<?php echo $lastname; ?>">
            <input type="text" name="username" placeholder="Username" class="box" value="<?php echo $username; ?>">
            <input type="email" name="email" placeholder="Email" class="box" value="<?php echo $email; ?>">
            <input type="password" name="password" id="password-field" placeholder="Password" class="box" value="<?php echo $password; ?>">
            <div class="toggle-password">
                <i class="fa-solid fa-eye"></i>
                <i class="fa fa-eye-slash"></i>
            </div>
            <div class="password-policies">
                <div class="policy-length">
                    At least eight (8) characters
                </div>
                <div class="policy-uppercase">
                    At least one (1) uppercase letter
                </div>
                <div class="policy-lowercase">
                    At least one (1) lowercase letter
                </div>
                <div class="policy-number">
                    At least one (1) number
                </div>
                <div class="policy-special">
                    At least one (1) special character
                </div>
            </div>
            <input type="password" name="retype_password" placeholder="Re-type password" class="box">
            <input type="address" name="address" placeholder="Address" class="box" value="<?php echo $address; ?>">
            <input type="submit" value="Sign Up" class="btn" name="signup">
            Already have an account?<a href="login.php" id="signup"> Login Now</a>
        </div>
    </form>
</div>

<script src="signup.js"></script>
</body>
</html>
