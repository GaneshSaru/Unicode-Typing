<?php
require_once "user_management.php";
if (isset($_SESSION["user"])) {
    header("Location: main.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicode नेपाली Tying</title>
    <link rel="stylesheet" href="../css/send_otp.css">
    <script src="https://kit.fontawesome.com/e6ec068722.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="background">
    </div>
    <header>
        <nav class="navbar">
        <div class="logo">
            <a href="../index.php" class="logotext">
                <h2>Unicode नेपाली Typing</h2>
            </a>
        </nav>
    </header>
<!--Reset Password Section-->
    <div class="container">
        <div class="title-section">
            <h2 class="title">Forgot Your Login Password?</h2>
            <p class="para"> Please enter your email below to get the reset email. </p>
        </div>
        <form action="" method="POST" class="form">
            <div class="inputfield">
                <label for="" class="label-title"> Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email address">
                <span class="icon">&#9993;</span>
            </div>
            <!--Error and Success msz display-->
            <span class="error-txt"><?php echo $errors; ?></span>
            <div class="btn">
                <button class="cancel-btn" id="cancel-btn"><a href="login.php">Cancel</a></button>
                <button class="submit-btn" name="sendotp" type="submit">Send Password Reset Email</button>
            </div>
        </form>
</div>
</body>
</html>