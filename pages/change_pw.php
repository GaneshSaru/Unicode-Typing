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
    <link rel="stylesheet" href="../css/change_pw.css">
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
<!--Change Password Section-->
    <div class="container">
            <div class="title-section">
                <h2 class="title">Change Password</h2>
                <p class="para"> Please create your new password.</p>
                <hr>
            </div>
        <span class="success-txt"><?php echo $success; ?></span>
        <form action="" method="POST" class="form">
            <div class="input-field">
               <i class="fa-solid fa-lock"></i>
               <input type="password" name="newpassword" id="newpassword" placeholder="New Password"> 
               <i class="fa-regular fa-eye-slash"id="togglePassword"></i>
            </div>
            <div class="input-field">
               <i class="fa-solid fa-lock"></i>
               <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
            </div>
             <!--Error and Success message display -->
            <span class="error-txt"><?php echo $confirmError; ?></span>
            <span class="error-txt"><?php echo $errors; ?></span>
                <div class="btn-field">
                    <button class="change_pw" name="change_pw" type="submit">Change</button>
                </div>
        </form>
    </div>
    <script>
            const togglePassword = document.querySelector("#togglePassword");
            const newpassword = document.querySelector("#newpassword");
            const confirmpassword = document.querySelector("#confirmpassword");

            togglePassword.addEventListener("click",function(){
                const passwordtype = newpassword.getAttribute("type");
                newpassword.setAttribute("type", passwordtype  === "password" ? "text" : "password");

                const confirmpasswordtype = confirmpassword.getAttribute("type");
                confirmpassword.setAttribute("type", confirmpasswordtype === "password" ? "text" : "password");
 
                this.classList.toggle("fa-eye");
        });
    </script>
</body>
</html>