<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicode नेपाली Tying</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/e6ec068722.js" crossorigin="anonymous"></script>
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
                <a href="acc-set.php" class="sub-menu-link">
                <i class="fa-solid fa-gear"></i>
                    <p>Account Setting</p>
                </a>
                <a href="progress_report.php" class="sub-menu-link">
                <i class="fa-solid fa-chart-line"></i>
                    <p>Generate Report</p>
                </a>
                <a href="logout.php" class="sub-menu-link">
                <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Log out</p>
                </a>
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
    <!--APP-->
    <div class="app">
        <div class="wrapper">
            <!-- Difficulty -->
    <select multiple class="selectoption" id="difficulty">
        <option class="optionlist" value="Introduction" data-value="Introduction">Introduction</option>
        <option class="optionlist" value="Beginner" data-value="Beginner">Beginner</option>
        <option class="optionlist" value="Advanced" data-value="Advanced">Advanced</option>
        <option class="optionlist" value="Expert" data-value="Expert">Expert</option>
    </select>

    <!-- Key Row -->
    <select multiple class="selectoption" id="keyRow">
        <option class="optionlist" value="homekey" data-value="homekey">Home Key</option>
        <option class="optionlist" value="topkey" data-value="topkey">Top Key</option>
        <option class="optionlist" value="bottomkey" data-value="buttomkey">Bottom Key</option>
        <option class="optionlist" value="allkey" data-value="allkey">All Key</option>  
    </select>

    <!-- Lessons -->
    <select multiple class="selectoption" id="lessons">
        <option class="optionlist" value="lesson1" data-value="lesson1">Lesson 1</option>
        <option class="optionlist" value="lesson2" data-value="lesson2">Lesson 2</option>
        <option class="optionlist" value="lesson3" data-value="lesson3">Lesson 3</option>
        <option class="optionlist" value="lesson4" data-value="lesson4">Lesson 4</option>
        <option class="optionlist" value="lesson5" data-value="lesson5">Lesson 5</option>
        <option class="optionlist" value="lesson6" data-value="lesson6">Lesson 6</option>
        <option class="optionlist" value="lesson7" data-value="lesson7">Lesson 7</option>
        <option class="optionlist" value="lesson8" data-value="lesson8">Lesson 8</option>
        <option class="optionlist" value="lesson9" data-value="lesson9">Lesson 9</option>
        <option class="optionlist" value="lesson10" data-value="lesson10">Lesson 10</option>
    </select>
            <div class="lvlprogress">
                    <h4>Progress Bar</h4>
                    <div class="levelbar">
                        <div class="progressbar" id="progressbar"></div>
                    </div>
                <div class="username">
                    <label for="">User:</label> 
                    <input type="text" value="<?php if (
                        isset($_SESSION["user"])
                    ) {
                       echo $current_username; 
                    } else {
                        echo "unknown user";
                    } ?>" readonly    >
                    <span></span>
                </div>
            </div>

            <div class="typingdetils">
                <p>Total Letters :</p>
                <p>Mistake Letters :</p>
                <p>Speed (WPM) :</p>
                <p>Accuracy (%) :</p>
                <p>Time Taken (s) :</p>
            </div>
            <div class="typingdata">
                <p><span id="totalLetters">00</span></p>
                <p><span id="mistakeLetters">00</span></p>
                <p><span id="speed">00</span></p>
                <p><span id="accuracy">00</span></p>
                <p><span id="timeTaken">00</span></p>
            </div>
        </div>
    </div>

<div class="container">

        <div class="content">
            <div class="wordDisplay" id="wordDisplay"></div>
            <div class="typedWord" id="typedWord"></div>
        </div>
        <audio id="correct" src="../audio/keypress.mp3"></audio>
        <audio id="error" src="../audio/errorbuzz.mp3"></audio>

<!--KEYBOARD DESIGN-->
<div class="housing" id="housing active">
    <div class="layout">
         <!-- Number Keys -->
        <div class="numkey">
            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>`</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="~">॥</div>
                        <div data-key="`">ञ</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>1</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="!">ज्ञ</div>
                        <div data-key="1">१</div> 
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">          
                        <div>2</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="@">ई</div>
                        <div data-key="2">२</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
        
                        <div>3</div>
                    </div>  
                    <div class="nep_font">
                        <div data-key="#">घ</div>
                        <div data-key="3">३</div>
                    </div>
                </div>

            </div><div class="key">
                <div class="key_show">
                    <div class="eng_font">           
                        <div>4</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="$">द्ध</div>
                        <div data-key="4">४</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">          
                        <div>5</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="%">छ</div>
                        <div data-key="5">५</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">           
                        <div>6</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="^">ट</div>
                        <div data-key="6">६</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>7</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="&">ठ</div>
                        <div data-key="7">७</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>8</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="*">ड</div>
                        <div data-key="8">८</div>
                    </div>
                </div>
                
            </div>
            
            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>9</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="(">ढ</div>
                        <div data-key="9">९</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>0</div>
                    </div>

                    <div class="nep_font">
                        <div data-key=")">ण</div>
                        <div data-key="0">०</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>_</div>
                        <div>-</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="_">ओ</div>
                        <div data-key="-">औ</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">        
                    <div class="eng_font">
                        <div>+</div>
                        <div>=</div>
                    </div>

                    <div class="nep_font">
                        <div style="font-size: 8px;" data-key="+">(ZWNJ)</div>
                        <div style="font-size: 8px;" data-key="=">(ZWJ)</div>
                    </div>
                </div>
            </div>

            <div class="backspacekey key">
                    <div class="rkey-text">
                          <div data-key="Backspace">Backspace</div>
                    </div>
            </div>

        </div>


         <!-- Top Keys -->
        <div class="topkey">
            <div class="tabkey">
                    <div class="lkey-text" data-key="Tab">
                        Tabs
                    </div>
            </div>
             
            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>Q</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="Q">त्त</div>
                        <div data-key="q">त्र</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>W</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="W">ड्ढ</div>
                        <div data-key="w">ध</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>E</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="E">ऐ</div>
                        <div data-key="e">भ</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>R</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="R">द्ब</div>
                        <div data-key="r">च</div>
                    </div>
                </div>

            </div><div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>T</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="T">ट्ट</div>
                        <div data-key="t">त</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>Y</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="Y">ठ्ठ</div>
                        <div data-key="y">थ</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>U</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="U">ऊ</div>
                        <div data-key="u">ग</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>I</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="I">क्ष</div>
                        <div data-key="i">ष</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>O</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="O">इ</div>
                        <div data-key="o">य</div>
                    </div>
                </div>  
            </div>
            
            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>P</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="P">ए</div>
                        <div data-key="p">उ</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>[{</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="{">ृ</div>
                        <div data-key="[">र्</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>}]</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="}">ै</div>
                        <div data-key="]">े</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>\</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="|">ं</div>
                        <div data-key="\">्</div>
                    </div>
                </div>
            </div>

        </div>


            <!-- Home keys -->
        <div class="homekey">

            <div class="capslock key">
                <div class="lkey-text">
                      <div data-key="CapsLock">Caps lock</div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>A</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="A">आ</div>
                        <div data-key="a">ब</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>S</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="S">ङ्क</div>
                        <div data-key="s">क</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>D</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="D">ङ्ग</div>
                        <div data-key="d">म</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>F</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="F">ँ</div>
                        <div data-key="f">ा</div>
                    </div>
                </div>

            </div><div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>G</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="G">द्द</div>
                        <div data-key="g">न</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>H</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="H">झ</div>
                        <div data-key="h">ज</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>J</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="J">ो</div>
                        <div data-key="j">व</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>K</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="K">फ</div>
                        <div data-key="k">प</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>L</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="L">ी</div>
                        <div data-key="l">ि</div>
                    </div>
                </div>
                
            </div>
            
            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>;</div>
                    </div>

                    <div class="nep_font">
                        <div data-key=":">ट्ठ</div>
                        <div data-key=";">स</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>' "</div>
                    </div>

                    <div class="nep_font">
                        <div data-key='"'>ू</div>
                        <div data-key="'">ु</div>
                    </div>
                </div>
            </div>

            <div class="enterkey key">
                <div class="rkey-text">
                      <div data-key="Enter">Enter</div>
                </div>
            </div>

        </div>

         <!-- Buttom keys -->
        <div class="buttomkey">

            <div class="shiftkey key">
                <div class="lkey-text" data-key="Shift">
                      Shift
                </div>
            </div> 
            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>Z</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="Z">क्क</div>
                        <div data-key="z">श</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>X</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="X">ह्य</div>
                        <div data-key="x">ह</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>C</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="C">ऋ</div>
                        <div data-key="c">अ</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>V</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="V">ॐ</div>
                        <div data-key="v">ख</div>
                    </div>
                </div>

            </div><div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>B</div>
                    </div>
                    <div class="nep_font">
                        <div data-key="B">ौ</div>
                        <div data-key="b">द</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>N</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="N">द्य</div>
                        <div data-key="n">ल</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>M</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="M">ड्ड</div>
                        <div data-key="m">ः</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>,</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="<">ङ</div>
                        <div data-key=",">ऽ</div>
                    </div>
                </div>
            </div>

            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>.</div>
                    </div>

                    <div class="nep_font">
                        <div data-key=">">श्र</div>
                        <div data-key=".">।</div>
                    </div>
                </div>
                
            </div>
            
            <div class="key">
                <div class="key_show">
                    <div class="eng_font">
                        <div>/</div>
                    </div>

                    <div class="nep_font">
                        <div data-key="?">रु</div>
                        <div data-key="/">र</div>
                    </div>
                </div>
            </div>

            <div class="shiftkey key">
                <div class="rkey-text" data-key="Shift">
                      Shift
                </div>
            </div>

        </div>

         <!-- Control keys -->
        <div class="controlkey">

            <div class="ctrlkey key">
                <div class="lkey-text" data-key="Control">
                    Ctrl
                </div>
            </div>

            <div class="fnkey key">
                <div class="lkey-text" data-key="Fn">
                    fn
                </div>
            </div>

            <div class="winkey">
                <div class="lkey-text" data-key="Meta">
                    Win
                </div>
            </div>

            <div class="altkey">
                <div class="lkey-text" data-key="Alt">
                    Alt
                </div>
            </div>

            <div class="spacebar key" data-key=" ">
                   Spacebar
            </div>

            <div class="altkey key">
                <div class="rkey-text" data-key="Alt">
                    Alt
                </div>
            </div>

            <div class="ctrlkey key">
                <div class="rkey-text" data-key="Control">
                    Ctrl
                </div>
            </div>

        </div>

        <!--layout n housing end-->
    </div>
</div>   
</div>
<footer>
    <strong>Refresh if any error occurs:</strong> If you encounter any errors, please try refreshing the page.
</footer>

<script src="../script/typing.js"></script>
<script src="../script/keyhover.js"></script>
</body>
</html>
    
