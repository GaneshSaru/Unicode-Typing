<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicode नेपाली Tying</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/e6ec068722.js" crossorigin="anonymous"></script>  
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
</head>
<body>
<div class="background">
</div>
    <header>
    <nav class="navbar">
        <!--TITLE-->
        <div class="logo">
            <a href="index.php" class="logotext">
                <h2>Unicode नेपाली <span class="typing"></span></h2>
            </a>
        <!--Js to animate Title Text-->
            <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
                    <script>
                        var typed =new Typed(".typing", {
                        strings:["Typing"],
                        typeSpeed: 120,
                        backSpeed: 100,
                        loop: true 
                         })
            </script>
            
        <?php
        if (isset($_SESSION["user"])) {
            require_once "pages/database_conn.php";
            $id = $_SESSION['user']['id'];
            $select_query = "SELECT * FROM users WHERE id = ?";
            $stmt_fetch = mysqli_stmt_init($conn);
            $prepareStmt_fetch = mysqli_stmt_prepare($stmt_fetch, $select_query);
            if ($prepareStmt_fetch) {
                mysqli_stmt_bind_param($stmt_fetch, "i", $id);
                mysqli_stmt_execute($stmt_fetch);
        
                $result = mysqli_stmt_get_result($stmt_fetch);
                $row = mysqli_fetch_assoc($result);
            }
            $current_username=$row['username'];
            echo '
           <img src="_images/profile/'.$row['image'].'" alt="users-profile" class="profile">
           <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="_images/profile/'.$row['image'].'" alt="users-profile">
                    <h3><span>' ?>
                    <?php echo $current_username; ?>
                    <?=
                '</span></h3> 
                </div>
                <hr>
                <a href="pages/acc-set.php" class="sub-menu-link">
                <i class="fa-solid fa-gear"></i>
                    <p>Account Setting</p>
                </a>
                <a href="pages/logout.php" class="sub-menu-link">
                <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Log out</p>
                </a>
            </div>
        </div>';
        } else {
            echo '
         <div class="links">
            <a href="pages/login.php"  class="login-btn">Log In</a>
            <a href="pages/signup.php" class="signup-btn">Sign Up</a>
        </div> ';
        }
        ?>
        <!-- js for users-profile-->
        <script>
            let profile = document.querySelector(".profile");
            let subMenu = document.querySelector(".sub-menu-wrap");

            profile.onclick = function(){
                subMenu.classList.toggle("open-menu");
                profile.classList.toggle("open-menu");
            }

            document.onclick = function(e){
                if(!subMenu.contains(e.target) && !profile.contains(e.target)){
                    subMenu.classList.remove("open-menu");
                    profile.classList.remove("open-menu");
                }
            }
        </script>
        </nav>
    </header>

     <!--Display Details-->
     <main>
        <div class="info">
              Unicode Nepali Typing Is a Web Typing Platform.<br>
              Learn To Type Faster and Easier In Nepali.
         </div>
              <div class="box1">
                  <h4>About</h4>
                  <p>Get information on Unicode Keyboard Layout and Typing Guide.</p>  
                  <button class="click-btn">
                    <a href="pages/guide.php" class="btn1">Click Here</a>  
                  </button>        
              </div>

              <div class="box2">
                <h4>Start Typing</h4>
                <p>Get started typing here.</p>
                <button class="click-btn">
                    <a href="pages/main.php" class="btn2">Start Typing</a>
                </button>    
            </div>
    </main>
</body>
</html>
    
</body>
</html>