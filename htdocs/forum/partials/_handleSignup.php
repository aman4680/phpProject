<?php
    $showError = "false";
    $showAlert = true;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include '_dbconnect.php';        
        $user_email = $_POST['user'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        $existSql = "SELECT * FROM `USERS` WHERE user_email = '$user_email'";
        $result = mysqli_query($conn, $existSql);
        $numRows = mysqli_num_rows($result);        
        if($numRows > 0)
        {
            $showError = "This Email already exists";
        }
        else
        {
            if($pass == $cpass)
            {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    $showAlert = true;
                    header("location: /forum/index.php?signupsuccess=true");
                    exit();
                }
            }
            else
            {
                $showError = "Password Field and Confirm Password Field do not match";
                header("location: /forum/index.php?signupsuccess=false&error=$showError");
                exit();
            }
        }
        header("location: /forum/index.php?signupsuccess=false&error=$showError");
        exit();
    }
?>