<?php 
    $insert = false;
    $exists = false;
    $match = true;
    $hash="";
    include('req/condata.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $sql = "SELECT username from logtable";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['username'] == $username){
                $exists = true;
                break;
            }
        }
        if($password == $cpassword && $exists == false)
        {            
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `logtable` (`username`, `password`, `DOJ`) VALUES ('$username', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql); 
            $insert = true;           
        }  
        else{
            if($password != $cpassword){
                $match = false;
            }
        }           
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Sign Up</title>
  </head>
  <body>    
    <?php require('req/_navbar.php')?>
    <?php
        if($insert){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>SUCCESS!</strong> Your form has been submitted successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
        if($exists){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Alert!! &nbsp;&nbsp;&nbsp; </strong>This username already exists, Change Username.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
        if(!$match){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Alert!! &nbsp;&nbsp;&nbsp;</strong>Password Field & Confirm Password Field doesn't match.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
    ?>
    <div class="container my-4">
        <h1 class="text-center">Sign Up to continue</h1>
        <form action="/loginsystem/signup.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" maxlength="25" class="form-control" id="username" name="username" aria-describedby="username">                
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>            
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>                               
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>