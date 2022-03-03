<?php
    $showError = "false";
    $showAlert = true;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include '_dbconnect.php';        
        $loginEmail = $_POST['loginEmail'];
        $loginPass = $_POST['loginPass'];
        $sql = "SELECT * FROM `USERS` WHERE user_email='$loginEmail'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);        
        if($numRows == 1)
        {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($loginPass, $row['user_pass']))
            {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $loginEmail;
                echo 'Logged in '. $loginEmail;
                header("location: /forum/index.php?loginsuccess=true");
                exit();
            }
            else
            {
                header("location: /forum/index.php?loginsuccess=false");
                exit();
            }
        }
        header("location: /forum/index.php?loginsuccess=false");
        exit();
    }
?>