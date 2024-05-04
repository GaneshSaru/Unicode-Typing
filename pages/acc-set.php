<?php
    require_once "user_management.php";
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit;
    } 
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="Tue, 01 Jan 1995 12:12:12 GMT">
<meta http-equiv="Pragma" content="no-cache">
    <title>Account Settings</title>
    <link rel="stylesheet" href="../css/acc-set.css">
    <script src="https://kit.fontawesome.com/e6ec068722.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="background">
    </div>
    <div class="contianer">
        <h4>Account Settings</h4>
        <div class="box overflow-hidden">
            <!--Option Lists-->
            <div class="menu-options">
                <div class="column1">
                    <div class="list-group" id="list-group">
                        <a onclick="tabs(0)" data-active="general" class="list-group-item active" data-toggle="list"
                                href="#account-general">General</a>
                        <a onclick="tabs(1)" data-active="change-password" class="list-group-item " data-toggle="list"
                                href="#account-change-password">Change password</a>
                        <a onclick="tabs(2)" data-active="delete" class="list-group-item " data-toggle="list"
                                href="#account-delete">Delete Account</a>
                <!--    <a onclick="tabs(3)" data-active="help" class="list-group-item " data-toggle="list"
                                href="#account-help&support">Help & Support</a>
                        -->     
                    </div>
                </div>
                <script>    //active button hover
                    var btnContainer = document.getElementById("list-group");
                    var btns = btnContainer.getElementsByClassName("list-group-item");
            
                    for(var i=0; i < btns.length; i++)
                    {
                        btns[i].addEventListener('click', function(){
                            var current = document.getElementsByClassName("active");
                            current[0].className = current[0].className.replace(" active");
                            this.className += " active";
                        })
                    }
                </script>
                <!--Details Display-->
                <div class="column2">
                    <div class="contents" id="contents">
                        <!--General Desk-->
                        <div class="general tabshow" id="account-general">
                        <form action="acc-set.php" method="POST" enctype="multipart/form-data">
                            <div class="profile-pic">
                                <img src="../_images/profile/<?php echo $row['image'];?>" alt="Profile Picture"> 
                                <label for="uploadfile" class="upload-btn">
                                    Upload new photo
                                    <input type="file" id="uploadfile" name="uploadfile"style="display:none">
                                </label>
                            </div>
                            <button type="submit" name="uploadimg" class="uploadimg">Change Profile Picture</button>
                            <hr>
                        </form>
    
                            <script>    //trigger a choose file fn on clicking label
                                let upload =document.querySelector(".upload-btn");
                                upload.onclick=function handleLabelClick(){
                                    document.getElementById("image").click();
                                }
                            </script>
                            <script type="text/javascript">
                            document.getElementById("image").onchange = function(){
                                document.getElementById("form").submit();
                            };
                            </script>
                         <form action="acc-set.php" method="POST" >
                            <div class="from-box">
                                <div class="form-group">
                                    <label for="newusername" class="form-label">Username:
                                    </label>
                                    <input type="text" name="newusername" id="newusername" class="form-control" placeholder="<?php echo $row['username'];?>">
                                    <span class="validation-message"></span>   
                                    <div id="user-availability-status"></div> 
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">E-mail: <?php echo ($_SESSION['user']['email'])?> </label>
                                    <div class="comment">
                                    “To change your username, enter the new username and click ‘Save Changes’.”
                                    </div>

                                   <!-- <input type="text" name="newemail" class="form-control" value="<?php //echo ($_SESSION['user']['email'])?>" readonly style="border:none"></label> 
                                    <div class="warning">
                                        Your email is not confirmed. Please check your inbox.<br>
                                        <a href="javascript:void(0)">Resend Confirmation</a>
                                    </div>
                                    -->
                                </div> 
                            </div>
                            <div class="btns">
                                <button type="submit" id="update_username" name="update_username" class="save-btn">Save Changes</button>&nbsp;
                                <button type="submit" name="cancel" class="cancle-btn">Cancel</button>
                            </div>
                            </form>
                        </div>
                        <!--Privacy desk Desk-->
                        <div class="privacyset tabshow" id="account-change-password">
                            <form action="acc-set.php" method="POST">
                            <div class="form-box">
                                    <div class="form-group">
                                        <label for="" class="form-label">Current Password</label>
                                            <input type="password" class="password" name="currentpw" id="currentpw" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">New Password</label>
                                        <input type="password" class="password" name="newpw" id="newpw" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Repeat new Password</label>
                                        <input type="password" class="password" name="repeatpw" id="repeatpw" class="form-control">
                                    </div> 
                                    <div class="showpassword">
                                    <input type="checkbox" id="showpassword"><label for="showpassword">Show Passowrd</label>
                                    </div>
                                </div>
                                <div class="btns">
                                    <button type="submit" name="update_password" class="save-btn">Save Changes</button>&nbsp;
                                    <button type="submit" name="cancel" class="cancle-btn">Cancel</button>
                                </div>
                            </form>
                            </div>
                            <!--Delete Account Desk-->
                            <div class="deleteacc tabshow" id="account-delete">
                                <form action="acc-set.php" method="POST">
                                <div class="form-box">
                                    <div class="form-group">
                                        <h5>Delete My Profile</h5>
                                        <hr>
                                        <p>Once you do, all data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
                                        <label for="" class="form-label">Confirm Passowrd</label>
                                        <div class="showconfirmpassword">
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                            <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="btns">
                                    <button type="submit" name="delete" class="save-btn">Delete</button>&nbsp;

                                    <button type="submit" name="cancel" class="cancle-btn">Cancel</button>
                                </div>
                                </form>
                            </div>
                          
                            <!-- Help and Support Desk--
                            <div class="helpdesk tabshow" id="account-help&support">
                                <form action="acc-set.php" method="POST">
                                <div class="form-box">
                                    <div class="form-group">
                                        <label for="" class="form-label">Report</label>
                                        <input type="text" name="report" id="report" class="form-control">
                                    </div>
                                </div>
                                <div class="btns">
                                    <button type="submit" name="send" class="save-btn">Send</button>&nbsp;
                                    <a href="">
                                    <button type="submit" name="cancel" class="cancle-btn">Cancel</button>
                                    </a>
                                </div>
                                </form>
                            </div>
                        -->
                    </div>
                </div>
            </div>        
    </div>
    </div>
    <!--js to show the contents of active links-->
    <script>
        const tabBtn = document.querySelectorAll(".list-group-item");
        const tab = document.querySelectorAll(".tabshow");

        function tabs(panelIndex){
            tab.forEach(function(node){
                node.style.display = "none";
            })
            tab[panelIndex].style.display = "block";
        }
        tabs(0);

        //hide and show password text for change passowrd
        const showpassword = document.querySelector("#showpassword");
        const currentPassword = document.querySelector("#currentpw");
        const newPassword = document.querySelector("#newpw");
        const repeatPassword = document.querySelector("#repeatpw");
          showpassword.addEventListener("click", function() {
            const currentPasswordType = currentPassword.getAttribute("type") === "password" ? "text" : "password";
            currentPassword.setAttribute("type",currentPasswordType);

            const newPasswordType = newPassword.getAttribute("type") === "password" ? "text" : "password";
            newPassword.setAttribute("type",newPasswordType);

            const repeatPasswordType = repeatPassword.getAttribute("type") === "password" ? "text" : "password";
            repeatPassword.setAttribute("type",repeatPasswordType);
        });

        const togglePassword = document.querySelector("#togglePassword");
        const confirm_password = document.querySelector("#confirm_password");
        togglePassword.addEventListener("click", function() {
            const ConfirmType = confirm_password.getAttribute("type") === "password" ? "text" : "password";
            confirm_password.setAttribute("type", ConfirmType);
            this.classList.toggle("fa-eye");
        });
        
    </script>

</body>
</html>