<?php
require_once "user_management.php";
//session
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
    <link rel="stylesheet" href="../css/login.css">
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
    <!-- Log in form -->
        <div class="form-box" id="blur">
           <h1 class="login">Log In</h1>
           <form action="login.php" method="post">
              <div class="input-group">
              <!--Error and Success msz display-->
              <span class="error-txt"><?php echo $fieldError; ?></span>
                 <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Email">
                 </div>
                 <!--Error and Success msz display-->
                 <span class="error-txt"><?php echo $emailError; ?></span>
                 <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password">
                    <i class="fa-regular fa-eye-slash"id="togglePassword"></i>
                 </div>
                 <!--Error and Success msz display-->
                 <span class="error-txt"><?php echo $passwordError; ?></span>
              </div>
              <div class="remember-forgot">
                <!--
                <input type="checkbox" id="check" name="remember_me">
                 <label for="check" name="remember_me">Remember me</label>-->   
                 <a href="send_otp.php"><p class="forgot">Forgot password?</p></a>
                 
              </div>
              <div class="btn-field">
                 <button type="submit" name="login" value="login">Log In</button>
              </div>
              <div class="signup-link">
                 <p> Don't have an account? <a href="signup.php">Sign Up</a></p>
              </div>
           </form>
        </div>
        <script>
            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");

            togglePassword.addEventListener("click",function(){
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
 
                this.classList.toggle("fa-eye");
        });
        </script>
</body>
</html>