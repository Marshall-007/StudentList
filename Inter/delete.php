<?php
// here all we need is to delete the user
if (isset($_GET["id"])) {
    $id = $_GET["id"];


    // connecting to the database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "afribit";
// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Delete student from table 
$delete = "DELETE FROM student WHERE id = '$id'";
$connection->query($delete);


} 
// redirect 
header("Location: home.php");
exit;




?>