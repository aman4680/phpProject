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

    <style>
    .anchor {
        text-decoration: none;
        cursor: pointer;
        color: rgb(46, 43, 43);
    }
    </style>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id='$id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php                 
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];   
            $useremail = $_SESSION['useremail'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `dateOfEntery`) VALUES ('$th_title', '$th_desc', '$id', '$useremail', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
        }
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !!! </strong>Your query has been submitted.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    ?>

    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome !!! to <?php echo $catname;?> Forums</h1>
            <p class="lead my-4"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. Spam/ Advertising/ Self-Promotion in the forums is not allowed. Do not post
                copyright - infringing material. Do not post offensive links, posts or images. Do not crosspost
                questions. Remain respectful of other members at all times.</p>
            <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
        </div>
    </div>

    <div class="container my-5">
        <h2>Start a Discussion</h2>
    </div>

    <div class="container my-5">
        <?php
            $noResult = true;
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id='$id'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $threadId = $row['thread_id'];
                $threadTitle = $row['thread_title'];
                $threadDesc = $row['thread_desc'];
                $threadAskedBy = $row['thread_user_id'];
            echo '<div class="container my-4">
                    <div class="media">
                        <img src="img/userDefault.png" width="54px" class="mr-4" alt="...">
                        <div class="media-body">                        
                            <h5 class="mt-0"><a class="anchor" href="threads.php?threadid='. $threadId .'">'. $threadTitle .'</a></h5>
                            <p class="lead">Posted by: &nbsp;&nbsp;'. $threadAskedBy .'</p>
                            <p>'. $threadDesc .'</p>
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
                      <h2 class="display-4">No Querries Asked</h2>
                      <p class="lead">Be the first person to ask Querry.</p>
                    </div>
                  </div>';
                }
            ?>
    </div>

    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo '<div class="container my-5">
            <h2>Ask your Querry</h2>
                <form action="' .$_SERVER['REQUEST_URI']. '" class="my-4" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="lead"><strong>Querry Title</strong></label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Ask questions as short as crisp as possible.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="lead"><strong>Querry Description</strong></label>
                        <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>';
        }
        else
        {
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h2 class="display-4">Ask your query</h2>
                    <p class="lead">You are not logged in. So you can\'t ask querries right now. So to ask your query first you need to login, so please login.</p>
                </div>
            </div>';
        }
    ?>

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