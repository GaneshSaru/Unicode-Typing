<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/guide.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <!--TITLE-->
            <div class="logo">
                <a href="../index.php" class="logotext">
                    <h2>Unicode नेपाली Typing</h2>
                </a>
            <?php
            if (isset($_SESSION["user"])) {
                require_once "database_conn.php";
                $id =$_SESSION['user']['id'];
                $select_query = "SELECT * FROM users WHERE id = '$id'";
                $result = mysqli_query($conn, $select_query);
                $row = mysqli_fetch_assoc($result);
                $current_username=$row['username'];
                echo '
                <img src="../_images/profile/'.$row['image'].'" alt="users-profile" class="profile">
                <div class="sub-menu-wrap" id="subMenu">
                 <div class="sub-menu">
                     <div class="user-info">
                         <img src="../_images/profile/'.$row['image'].'" alt="users-profile">
                         <h3><span>'?>
                        <?php echo $current_username; ?>
                        <?=
                    '</span></h3> 
                    </div>
                    <hr>
                </div>
            </div>';
            } else {
                echo '
             <div class="links">
                <a href="login.php"  class="login-btn">Log In</a>
                <a href="signup.php" class="signup-btn">Sign Up</a>
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
        <section class="first">
            <div class="info">
                    <p>Unicode Nepali Typing, your go-to web platform for mastering Nepali typing using the traditional keyboard layout. Elevate your typing skills with our range of lessons and levels, designed to help you improve your accuracy and speed. Keep track of your progress easily with detailed reports. Start your journey towards becoming a proficient Nepali typist today!</p>
           </div> 
           <img src="../_images/clipart.jpg" alt="clipart">
        </section>

        <section class="second">
            <div class="container">
                <div class="file">
                    <p>Download Nepali Unicode Traditional Keyboard and Key layout</p>
                    <a href="../files/Traditional_Nepali_Unicdoe.zip" download="Traditional_Unicode.zip">Click here</a>
                </div>
                <h4>Typing Guide and User Manual</h4>
                <hr>
                <h4>Basic Rules:</h4>
                <h5>1. Finger Placement:</h5>
                   <p>Place your fingers on the home row keys: ASDF for the left hand and JKL; for the right hand. Use your thumbs for the spacebar.</p> 
                <h5>2. Use All Fingers:</h5>
                   <p> Avoid favoring certain fingers. Distribute typing tasks evenly among all fingers to increase speed and accuracy.</p>
                <h5>3. Correct Finger Usage:</h5> 
                    <p>Each finger is responsible for specific keys(as shown in the keyboard layout below). For example, the pinky fingers control the shift keys, while the thumbs manage the spacebar.</p>
                <h5>4. Uppercase letters and symbols: </h5>
                    <p> Press and hold the Shift key with either of your pinky fingers. If alphanumeric key is in right hand side use Left hand side 'Shift key' and vice versa. 
                    <br>
                    
                    For example, to type an uppercase "F": <br>
                    i. Hold down the Shift key with your right pinky finger. <br>
                    ii. Press the "F" key with your left index finger. <br>
                    iii. Release both keys. <br>
                    Similarly, for typing symbols like "@" or "$", follow the same procedure of holding down the Shift key and pressing the appropriate alphanumeric key.
                </p>
                <h5>5. Correct Mistakes Immediately:</h5>
                <p>Correct errors as soon as they occur to prevent the formation of bad typing habits.</p>
                <h5>6. Practice Regularly:</h5>
                <p> Regular practice is key to improving typing speed and accuracy. Use online typing tutors or typing games to enhance your skills.</p>
                   <h4>Keyboard layout</h4>
                <img src="../_images/layout.jpg" alt="keyboard layout">
                <img src="../_images/keyboardlayout Traditional.jpg" alt="keyboardlayout Traditional">
                <img src="../files/Keys1.png" alt="keylayout1" style="height: 600px;">
                <img src="../files/Keys2.png" alt="keylayout2">
            </div>
            </section>
        <section class="third">
            <div class="notes">
                <h4>युनिकोड नेपाली टाईपिङ् प्रयोग गरी टाईपिङ् अभ्यास गर्दा ध्यान दिनुपर्ने कुराहरुः</h4>
                <li>नेपाली अंकहरु लेख्न परेमा किबोर्ड माथिका Number Key सिधै प्रेस गर्नुहोस् ।</li>
                <li>किबोर्डमा अवस्थित अक्षरहरु जस्तै ङ्ग, ह्य, क्क, त्त, ड्ढ, ट्ट आदी, सम्बन्धित किहरु प्रयोग गर्नुहोस् ।</li>
                <li>यसै गरी अन्य अक्षर लेख्ने:</li>
                    <p>जस्तै : प्र, व्र, क्र बनाउन परेमा : पहिला आवत्श्यक अक्षर लेखेर \ बटन प्रेस गरी 'र' अर्थात / बटन प्रेस गर्नुहोस् ।</p> <br>
                    <p>जस्तै : प्रविन लेख्न परेमा : पहिला 'प' लेखि त्यसपछि \ बटन प्रेस गरी / बटन अर्थात 'र' अक्षर प्रेस गर्नुहोस् ।</p>
                <li>आधा अक्षर लेख्न परेमा जस्तै : 'ध्यान'; पहिला 'ध' लेखेर \ बटन प्रेस गर्ने </li>
                <li>'र्‍याल' लेख्न परेमा पहिला 'र्' बटन प्रेस गरी '=' बटन प्रेस गरी 'याल' लेख्नुहोस् ।</li>
                <li>मात्रा:आकार (ा), इकार(ि),ईकार(ी), उकार(ु), ऊकार(ू), एकार(े), ‌‌ऐकार(ै), ओकार(ो), औकार(ौ), आदी लेख्न पहिला व्यंजन अक्षर लेखेर पछि मात्रा अक्षर लेख्ने </li>
                <li>नेपाली युनिकोड ट्रेडिशनल किबोर्ड(Nepali Unicode Traditional Keyboard) मा अल्पविराम (comma ,) समावेश नभएको तर युनिकोड नेपाली टाईपिङ् प्रयोग गर्दा ',' कि नै प्रयोग गर्नुहोस् । </li>
                <li>किबोर्डमा अवस्थित नभएका अक्षरहरु टाईपिङ् गर्ने उदाहरणहरुः</li>
            </div>
        </section>
       
        <section class="forth">
                <img src="../files/Example.jpg" alt="Examples" style="height: 1200px;">  
                <a href="../files/keylayouts&hints.pdf" download="keylayouts&hints.pdf">Download above files.</a>
        </section>
    <footer>
        <p class="p_title">Unicode नेपाली Typing</p>
        <p style="text-decoration: underline; text-underline-offset: 5px;">Developed By: </p>
        <p>
        Ganesh Saru <br>
        Himal Thapa <br>
        Ramchandra Karki <br>
        (BECE_2021)
        </p>
    </footer>  
</body>
</html>
