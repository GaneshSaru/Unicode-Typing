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
    <link rel="stylesheet" href="../css/signup.css">
    <script src="https://kit.fontawesome.com/e6ec068722.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="background">
</div>
    <header>
        <nav class="navbar">
        <div class="logo">
            <a href="/unicode_nepali_typing/index.php" class="logotext">
                <h2>Unicode नेपाली Typing</h2>
            </a>
        </nav>
    </header>
    <!-- Sign up form -->
    <div class="form-box">
      <h1 class="signup">Sign Up</h1>
      <form action="" method="post">
         <div class="input-group">
            <!--Error and Success message display -->
            <span class="error-txt"><?php echo $fieldError; ?></span>
            <span class="success-txt"><?php echo $success; ?></span>

            <div class="input-field">
               <i class="fa-solid fa-user"></i>
               <input type="text" name="username" id="username" placeholder="Username">
            </div>
             <!--Error and Success message display -->
            <span class="error-txt" ><?php echo $usernameError; ?></span>

            <div class="input-field">
               <i class="fa-solid fa-envelope"></i>
               <input type="email" name="email" id="email" placeholder="Email">
            </div>
             <!--Error and Success message display -->
            <span class="error-txt"><?php echo $emailError; ?></span>

            <div class="input-field">
               <i class="fa-solid fa-lock"></i>
               <input type="password" name="password" id="password" placeholder="Password"> 
               <i class="fa-regular fa-eye-slash"id="togglePassword"></i>
            </div>
             <!--Error and Success message display -->
            <span class="error-txt"><?php echo $passwordError; ?></span>

            <div class="input-field">
               <i class="fa-solid fa-lock"></i>
               <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
            </div>
             <!--Error and Success message display -->
            <span class="error-txt"><?php echo $confirmError; ?></span>
            <p> Already have an account? <a href="login.php">Log in</a></p>
         </div>
         <div class="btn-field">
            <button type="submit" value="signup" name="signup">Sign Up</button>
         </div>
      </form>
   </div>
   <script>
            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");
            const confirmpassword = document.querySelector("#confirmpassword");

            togglePassword.addEventListener("click",function(){
                const passwordtype = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", passwordtype);  

                const confirmpasswordtype = confirmpassword.getAttribute("type") === "password" ? "text" : "password";
                confirmpassword.setAttribute("type", confirmpasswordtype); 
 
                this.classList.toggle("fa-eye");
        });
   </script>
</body>
</html>