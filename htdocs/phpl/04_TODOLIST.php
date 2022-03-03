<?php
    $insert = false;
    $update = false;
    $delete = false;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "dbphp";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if(!$conn){
        die("Sorry we failed to connect".mysqli_connect_error());
    }

    // echo "$_SERVER['REQUEST_METHOD']";

    if(isset($_GET['delete']))
    {
        $sno = $_GET['delete'];
        $delete = true;
        $sql = "DELETE FROM `dbtable` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['snoEdit']))
        {
            $sno = $_POST['snoEdit'];
            $title = $_POST['titleEdit'];
            $description = $_POST['descriptionEdit'];
            $sql = "UPDATE `dbtable` SET `title` = '$title' , `description` = '$description' WHERE `dbtable`.`sno` = $sno";
            $result = mysqli_query($conn, $sql);
            if($result){ 
                $update = true;
            }
            else{
                echo "The record was not updated successfully because of this error ---> ". mysqli_error($conn);
            }
        }
        else
        {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $sql = "INSERT INTO `dbtable` (`Title`, `description`) VALUES ('$title', '$description');";
            $result = mysqli_query($conn, $sql);
            if($result){ 
                $insert = true;
            }
            else{
                echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
            }
        }        
    }

    // else{
    //     echo "The record was not deleted successfully because of this error ---> ". mysqli_error($conn);
    // } 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    
    <title>TODO LIST</title>
  </head>
  <body>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container my-4">
                <form action="/phpl/04_TODOLIST.php" method="post">
                <input type="hidden" name="snoEdit" id="snoEdit">
                    <div class="form-group">
                        <label for="titleEdit">Title</label>
                        <input type="note" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="titleEdit">            
                    </div>
                    <div class="form-group">
                        <label for="descriptionEdit">Description</label>
                        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
                    </div>        
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
  </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="/phpl/php.png" height="30px" alt="Error Loading Image"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
        if($insert){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>SUCCESS!</strong> Your record has been inserted successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
        
        if($update){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>SUCCESS!</strong> Your TODO list has been updated successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }

        if($delete){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>SUCCESS!</strong> Your record has been deleted successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
    ?>

    <div class="container my-4">
        <form action="/phpl/04_TODOLIST.php" method="post">
        <h2>Add a note to iNotes</h2>
            <div class="form-group">
                <label for="Note">Note Title</label>
                <input type="note" class="form-control" id="title" name="title" aria-describedby="emailHelp">            
            </div>
            <div class="form-group">
                <label for="textarea">Note description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>        
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container my-5">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `dbtable`";
                    $result = mysqli_query($conn, $sql);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $i += 1;
                        echo"<tr>
                            <td>".$i."</td>
                            <td>".$row['Title']."</td>
                            <td>".$row['Description']."</td>
                            <td><button class='btn btn-primary btn-sm edit' id=".$row['sno'].">Edit</button> &nbsp; <button class='btn btn-primary btn-sm delete' id=d".$row['sno'].">Delete</button> </td>
                        </tr>";     
                    }
                ?>
            </tbody>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element) =>{
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[1].innerText;
                description = tr.getElementsByTagName("td")[2].innerText;                
                titleEdit.value = title;
                descriptionEdit.value = description;   
                snoEdit.value = e.target.id;             
                $('#editModal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                snoDelete = e.target.id.substr(1);
                if (confirm("Are you sure you want to delete this note!")) {                    
                    window.location = `/phpl/04_TODOLIST.php?delete=${snoDelete}`;
                // TODO: Create a form and use post request to submit a form
                }
                else {
                
                }
            })
        })
  </script>
  </body>
</html>