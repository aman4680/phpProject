<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbphp";

// Establish a connection

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Sorry the connection has not established yet".mysqli_connect_error());
}
else{
    echo "Connection has been established<br>";
}

// Creating a database
// $sql = 'CREATE DATABASE dbphp';
// $result = mysqli_query($conn, $sql);

// if($result){
//     echo "<br>The database has been created!!!!!";
// }
// else{
//     echo "<br>Your database query was unable to create a database";
// }

// Create a table
// $sql = 'CREATE TABLE `dbphp`.`dbtable` ( `sno` INT NOT NULL AUTO_INCREMENT , `Name` VARCHAR(15) NOT NULL , `Role` VARCHAR(25) NOT NULL , `DOJ` DATETIME NOT NULL , PRIMARY KEY (`sno`))';
// $result = mysqli_query($conn, $sql);
// if($result){
//     echo "<br>The table has been created!!!!!";
// }
// else{
//     echo "<br>Your table query was unable to create a table";
// }

//  $sql = "INSERT INTO `dbtable` (`sno`,`Name`, `Role`, `DOJ`) VALUES ('1','Aman', 'Programmer', '2020-06-07 12:39:40')";
//  $sql = "INSERT INTO `dbtable` (`Name`, `Role`, `DOJ`) VALUES ('Aman', 'Programmer', '2020-06-07 12:39:40')";
//  $result = mysqli_query($conn, $sql);

// if($result){
//     echo "<br>The record in the table has been inserted!!!!!";
// }
// else{
//     echo "<br>The record has not inserted";
// }

$sql = "SELECT * FROM `dbtable`";
$result = mysqli_query($conn, $sql);
// $num = mysqli_num_rows($result);
// echo "$num";

while($row = mysqli_fetch_assoc($result)){
    echo $row['sno']." Hello ".$row['Name']." Welcome to ".$row['Role']." world";
    echo "<br>";    
}

?>