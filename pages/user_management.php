<?php
 session_start(); 
 require_once "database_conn.php";  

 $fieldError = "";  
 $usernameError = "";
 $emailError = "";
 $passwordError = "";
 $confirmError = "";
 $success = "";
 //--Signup Form validation--   
 if (isset($_POST["signup"])) {
     $username = $_POST["username"];
     $email = $_POST["email"];
     $password = $_POST["password"];
     $confirmpassword = $_POST["confirmpassword"];
     $passwordHash = password_hash($password, PASSWORD_DEFAULT);

     //email validation 
     $sql = "SELECT * FROM users WHERE email = '$email'";
     $result = mysqli_query($conn, $sql);
     $rowCount = mysqli_num_rows($result);

     if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
         $fieldError = "All field are required.";
     } elseif ($rowCount > 0) {                     //conditon checked for email validation
         $emailError = "Email already exits!";
     } else {
         if (strlen($password) < 8) {
             $passwordError = "Password must be at least 8 characters long.";
         }
         if ($password !== $confirmpassword) {
             $confirmError = "Password does not match.";
         }
          else {
             //insert the data into database if any error is not occured
             $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
             $stmt = mysqli_stmt_init($conn);
             $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
             if ($prepareStmt) {
                 mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);
                 if(mysqli_stmt_execute($stmt)){
                    $success = "You are registered successfully";
                    header("refresh:1.5,url=login.php");  // redirect to login page after delay of 1s
                    exit;
                 }else{
                    $error = "Registration failed. Please try again.";
                 }
             } else {
                echo'<script>alert("An error occurred. Please try again later.");</script>';
             }
         }
     }
}

    //--Login Form validation--
if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
    if(empty($email) || empty($password)){
        $fieldError = "All field are required.";
    }else{
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt_login =mysqli_stmt_init($conn);
            $prepareStmt_login = mysqli_stmt_prepare($stmt_login, $sql);
        if($prepareStmt_login){
                mysqli_stmt_bind_param($stmt_login,"s",$email);
                mysqli_stmt_execute($stmt_login);

                $result = mysqli_stmt_get_result($stmt_login);
                $user = mysqli_fetch_assoc($result);
            
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = $user;
                    header("Location: main.php"); //redirect
                    exit;
                } else {
                    $passwordError = "Password does not match.";
                }
            } else {
                $emailError = "Email does not match.";
            }  
        } 
        else{
            echo'<script>alert("Something went wrong");</script>';
        }
    }       
}

//Account Setting 
{
//to fetch the letest data
if(isset($_SESSION['user'])){
    $id =$_SESSION['user']['id'];
    $select_query = "SELECT * FROM users WHERE id = ?";
    $stmt_fetch = mysqli_stmt_init($conn);
    $prepareStmt_fetch = mysqli_stmt_prepare($stmt_fetch, $select_query);
    if($prepareStmt_fetch){
        mysqli_stmt_bind_param($stmt_fetch,"i",$id);
        mysqli_stmt_execute($stmt_fetch);

        $result = mysqli_stmt_get_result($stmt_fetch);
        $row = mysqli_fetch_assoc($result);
    }
}
    //To update username only
    if (isset($_POST['update_username'])) {
        $newusername = $_POST['newusername'];

        //retriving current_username
        $current_username=$row['username'];

        if(empty($newusername)){
                echo "<script>alert('Please fill in field to update.');</script>"; 
            }
        elseif($newusername!==$current_username){
                $updateUsername_query = "UPDATE users SET username = ? WHERE id = ?";

                $stmt_username = mysqli_stmt_init($conn);
                $prepareStmt_username = mysqli_stmt_prepare($stmt_username, $updateUsername_query);

                if($prepareStmt_username){
                    mysqli_stmt_bind_param($stmt_username,"si",$newusername,$id);
                    if(mysqli_stmt_execute($stmt_username)){
                        echo "<script>alert('Username updated successfully!');</script>"; 
                    }else{
                        echo "<script>alert('Username update failed. Please try again.');</script>"; 
                    }
                }else{
                    echo "<script>alert('Something went wrong!');</script>"; 
                }
            }
            else{
                echo "<script>alert('Username updated Fail!(Try differnt username from previous).');</script>";
            }
    }

//update profile image.
if (isset($_POST['uploadimg']) && isset($_FILES['uploadfile'])) {
    if (!empty($_FILES["uploadfile"]["name"])) {
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $folder = "../_images/profile/" . $filename;

            $sql = "UPDATE users SET image = ? WHERE id = ?";
            $stmt_image =mysqli_stmt_init($conn);
            $prepareStmt_image = mysqli_stmt_prepare($stmt_image,$sql);
            if($prepareStmt_image){
                mysqli_stmt_bind_param($stmt_image,"si",$filename,$id);
                if(mysqli_stmt_execute($stmt_image)){
                    if (move_uploaded_file($tempname, $folder)) {
                        echo "<script>alert('Profile updated Successfully!');</script>";
                    } else {
                        echo "<script>alert('Failed to upload image!');</script>";
                    }
                }else{
                    echo "<script>alert('Failed to update profile image!');</script>";
                }
            }else{
                echo "<script>alert('Something went wrong!');</script>";
            }  
        } else {
            echo "<script>alert('No image file selected!');</script>";
        }
}

    //To update password only
    if (isset($_POST['update_password'])) {
             $currentpassword = $_POST['currentpw'];
             $newpassword = $_POST['newpw'];
             $repeatpassword = $_POST['repeatpw'];
             $newpasswordHash = password_hash($newpassword, PASSWORD_DEFAULT);

        if(empty($currentpassword)|| empty($newpassword) || empty($repeatpassword))
            {  
                echo "<script>alert('All fields are required');</script>";

            }
            elseif(password_verify($currentpassword,$row["password"])){
                if (strlen($newpassword) < 8) {
                    echo "<script>alert('Password must be at least 8 characters long.');</script>";
    
                }else{
                    if($newpassword !== $repeatpassword) {
                    echo "<script>alert('Passwords do not match');</script>";
                    }
                    else{
                        $updatepw_query = "UPDATE users SET password = ? WHERE id = ?";

                        $stmt_updatepw = mysqli_stmt_init($conn);
                        $prepareStmt_updatepw = mysqli_stmt_prepare($stmt_updatepw,$updatepw_query);
                        if($prepareStmt_updatepw){
                            mysqli_stmt_bind_param($stmt_updatepw,"si",$newpasswordHash,$id);
                            if(mysqli_stmt_execute($stmt_updatepw)){
                                echo "<script>alert('Password updated successfully!');</script>";
                            }
                            else{
                                echo "<script>alert('Failed to upload password!');</script>";
                            }
                        }else{
                            echo "<script>alert('Something went wrong!');</script>";    
                        }
                    }
                }
            }else{
                echo "<script>alert('Incorrect current password');</script>";
            }
}
//delete account
if (isset($_POST['delete'])) {
        $confirmpassword = $_POST['confirm_password'];
   if(empty($confirmpassword))
       {  
           echo "<script>alert('Enter your current password');</script>";
       }else{
        if(password_verify($confirmpassword,$row["password"])) {
                //Begin a transaction
                mysqli_begin_transaction($conn);

                //Attempt to delete related rows in the progress table
                $del_progress_query = "DELETE FROM progress WHERE user_id IN (SELECT id FROM users WHERE id = ?)";
                $stmt_del_progress = mysqli_stmt_init($conn);
                $prepareStmt_del_progress = mysqli_stmt_prepare($stmt_del_progress,$del_progress_query);

                if($prepareStmt_del_progress)
                {
                    mysqli_stmt_bind_param($stmt_del_progress,"i",$id);

                    if(mysqli_stmt_execute($stmt_del_progress)){
                        $del_query = "DELETE FROM users WHERE id = ?";
                        $stmt_del_user = mysqli_stmt_init($conn);
                        $prepareStmt_del_user = mysqli_stmt_prepare($stmt_del_user,$del_query);

                        if($prepareStmt_del_user){
                            mysqli_stmt_bind_param($stmt_del_user,"i",$id);

                            if(mysqli_stmt_execute($stmt_del_user)){
                                mysqli_commit($conn);
                                echo "<script>alert('Account Deleted successfully!');</script>";
                                header("refresh:0.1,url=logout.php");
                                exit;
                            }else{
                                mysqli_rollback($conn);
                                echo "<script>alert('Failed to delete user.');</script>";
                            } 
                        }
                    }else{
                        //failed to delete user-progress
                        mysqli_rollback($conn);
                        echo "<script>alert('Failed to delete user');</script>"; 
                    }
                }else{
                    mysqli_rollback($conn);
                    echo "<script>alert('Something went wrong!');</script>";
                }
        }else{
            echo "<script>alert('Incorrect current password');</script>";
        }
   }
}
    
//on clicking cancel in acc-set page redirect to main.php 
if(isset($_POST['cancel'])){
        header('Location: main.php');
    }

}

//Password Reset Section
 $errors ="";
 $success="";
 $confirmError = "";
    if(isset($_POST['sendotp'])){
        $email = $_POST['email'];

       if(empty($email)){
        $errors ="Field required";
       }else{
            //check for the valid email address
            $check_email = "SELECT * FROM users WHERE email=?";
            $stmt_check = mysqli_stmt_init($conn);
            $prepareStmt_check = mysqli_stmt_prepare($stmt_check,$check_email);

            if($prepareStmt_check){
                mysqli_stmt_bind_param($stmt_check,"s",$email);
                mysqli_stmt_execute($stmt_check);
                $result = mysqli_stmt_get_result($stmt_check);

                if(mysqli_num_rows($result) > 0){
                    $code = rand(999999, 111111);

                    $insert_code = "UPDATE users SET code = $code WHERE email = ?";
                    $stmt_insert = mysqli_stmt_init($conn);
                    $prepareStmt_insert = mysqli_stmt_prepare($stmt_insert,$insert_code);

                    if($prepareStmt_insert){
                        mysqli_stmt_bind_param($stmt_insert,"s",$email);
                        mysqli_stmt_execute($stmt_insert);

                        //send OTP code via email 
                            $subject = "Password Reset Code";
                            $message = "Your password reset code is $code";
                            $sender = "From: unicodenepalityping@gmail.com";

                            if (mail($email, $subject, $message, $sender)){
                                $_SESSION['email']=$email;
                                header('location: reset_code.php');
                                exit;
                            }else{
                                $errors = "Failed while sending code!";
                            }  
                        }else{
                            echo "<script>alert('Something went wrong.Try again!');</script>";  
                        }
                    }else{
                        $errors = "This email address does not exist!";
                    }
            }else{
                echo "<script>alert('Something went wrong.Try again!');</script>";  
            }
        }      
    }

    //if user click check reset otp button
    if(isset($_POST['verify_code'])){
        $otp_code = $_POST['reset_otp'];

        if(!empty($otp_code)){
            $check_code = "SELECT * FROM users WHERE code = ?";
            $stmt_code = mysqli_stmt_init($conn);
            $prepareStmt_code = mysqli_stmt_prepare($stmt_code,$check_code);
            
            if($prepareStmt_code){
                mysqli_stmt_bind_param($stmt_code,"i",$otp_code);
                mysqli_stmt_execute($stmt_code);
                $result = mysqli_stmt_get_result($stmt_code);

                if(mysqli_num_rows($result)>0){
                    $fetch_data = mysqli_fetch_assoc($result);
                    $email = $fetch_data['email'];
                    $_SESSION['email'] = $email;
                    header('location: change_pw.php');
                    exit;
                }
                else{
                    $confirmError= "You've entered incorrect code!";
                }
            }
        }else{
          $errors = "Field Required!";
        }
    }

    //if user click change password button
if(isset($_POST['change_pw'])){
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];
        if(!empty($newpassword)){
            if($newpassword == $confirmpassword){
                $code = 0;
                $email = $_SESSION['email'];//getting this email using session
                $passwordHash = password_hash($newpassword, PASSWORD_DEFAULT);
                $update_pass = "UPDATE users SET code = ?, password = ? WHERE email = ?";
                $stmt_changepw = mysqli_stmt_init($conn);
                $prepareStmt_changepw = mysqli_stmt_prepare($stmt_changepw,$update_pass);
                if($prepareStmt_changepw){
                    mysqli_stmt_bind_param($stmt_changepw,"iss",$code,$passwordHash,$email);
                    if(mysqli_stmt_execute($stmt_changepw)){
                        $success = "Password changed successfully.";
                        header('refresh:1,url=login.php');
                        exit;
                    }else{
                        $errors= "Failed to change your password!";
                    }
                }else{
                    echo "<script>alert('Something went wrong!');</script>";
                }    
            }else{
                $confirmError = "Password not matched!";
            }
        }
        else{
            $errors ="Field required!";
        }
}
?>