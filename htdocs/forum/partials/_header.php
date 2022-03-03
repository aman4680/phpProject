<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>';

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo '<form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 mr-1" type="submit">Search</button>
            </form>
            <p class="text-light lead my-0 mx-3">Welcome '.$_SESSION['useremail'].'</p>
            <button type="button" class="btn btn-outline-success mx-2" ><a href="partials/_logout.php" style="text-decoration: none; color: #5cb85c">Logout</a></button>';
        }
        else
        {
            echo ' <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 mr-5" type="submit">Search</button>
            </form>
            <div>  
                <button type="button" class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#loginModal">Login</button>      
                <button type="button" class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#signupModal">Sign Up</button>             
            </div>';
        }
echo '</div>
</nav>';


include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true")
{
    echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
    <strong>Success !!! </strong>Now you can login.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false")
{
    echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
    <strong>Alert !!! </strong>Invalid credentials
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false")
{
    $showError = $_GET['error'];
    echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
    <strong>Error !!! </strong>'. $showError .'.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>