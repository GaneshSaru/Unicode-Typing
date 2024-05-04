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
    <link rel="stylesheet" href="../css/reset_code.css">
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
<!--Change Password Section-->
    <div class="container">
            <div class="title-section">
                <h2 class="title">Code Verication</h2>
                <p class="para"> We've sent a password reset otp to your<br>
                                Email: <?php if(isset($_SESSION['email'])){
                                echo ($_SESSION['email']);
                                } ?>
                </p>
                <hr>
            </div>
        <form action="" method="POST" class="form">
            <div class="input-field">
               <input type="text" name="reset_otp" id="reset_otp" placeholder="Reset Otp"> 
            </div>
             <!--Error and Success message display -->
            <span class="error-txt"><?php echo $confirmError; ?></span>
                <div class="btn-field">
                    <button class="verify_code" name="verify_code" type="submit">Submit</button>
                </div>
        </form>
    </div>
</body>
</html>