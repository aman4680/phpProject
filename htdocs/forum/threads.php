<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>iDiscuss - Coding Forum</title>

</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php
    $noResult = true;
    $th_id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id='$th_id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $threadTitle = $row['thread_title'];
        $threadDesc = $row['thread_desc'];
        $threadUserId = $row['thread_user_id'];
    }
    ?>

    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $threadTitle;?></h1>
            <p class="lead my-4"><?php echo $threadDesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. Spam/ Advertising/ Self-Promotion in the forums is not allowed. Do not post
                copyright - infringing material. Do not post offensive links, posts or images. Do not crosspost
                questions. Remain respectful of other members at all times.</p>
            <br>   
            <p class="lead">Posted by: <strong><em><?php echo $threadUserId; ?></em></strong></p>         
        </div>
    </div>

    <?php                 
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $th_comment = $_POST['comment'];  
            $th_comment_user = $_SESSION['useremail'];                      
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$th_comment', '$th_id', '$th_comment_user', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
        }
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !!! </strong>Your comment is submitted successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    ?>

    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo '<div class="container my-5">
            <h2>Post a comment</h2>
            <form action="' .$_SERVER['REQUEST_URI']. '" class="my-4" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="lead"><strong>Comment</strong></label>
                    <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-info">Post Comment</button>
            </form>
        </div>';
        }
        else
        {
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h2 class="display-4">Post a comment</h2>
                    <p class="lead">You can\'t post a comment because you are not logged in. So to post your comment first you need to login, so please login.</p>
                </div>
            </div>';
        }
    ?>

    <div class="container my-5">
        <h2>Comments</h2>
    </div>
    <div class="container my-5">
        <?php
            $noResult = true;            
            $sql = "SELECT * FROM `comments` WHERE thread_id='$th_id'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $commentId = $row['comment_id'];
                $commentContent = $row['comment_content'];
                $commentBy = $row['comment_by'];
                $commentOnDate = $row['comment_time'];
            echo '<div class="container my-4">
            <div class="media">
            <img src="img/userDefault.png" width="60px" class="mr-4 mt-2" alt="...">
            <div class="media-body">
                <p class="lead">Commented by : &nbsp; &nbsp;'. $commentBy .' on '. $commentOnDate .'</p>
                <p>'. $commentContent .'</p>
            </div>
            </div>
            </div>';
            }
        ?>
    </div>
    <div class="container">
        <?php 
                if($noResult){
                    echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h3 class="display-4">No comments till now</h3>
                      <p class="lead"><strong>Be the first person to Comment...</strong></p>
                    </div>
                  </div>';
                }
            ?>
    </div>


    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>