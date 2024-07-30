<?php
// connecting to the database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "afribit";
// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Variables that will store the data form the form 
$fname = "";
$lname = "";
$email = "";
$phone = "";
$studentid = "";

$error = "";
$success = "";

// Now we check of the data has bee sent using the post method 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $fname = $_POST["ifname"];
  $lname = $_POST["ilname"];
  $email = $_POST["iemail"];
  $phone = $_POST["iphone"];
  $studentid = $_POST["istudent"];


  // We use a do while because we want to 
  // always check if app the fields have been 
  // Filled in before sending to the database. 
  do {
    // We check if the fields have been filled in
    if ($fname == "") {
      $error = "Please fill in your first name";
      break;
    } else
  if ($lname == "") {
      $error = "Please fill in your last name";
      break;
    } else
if ($email == "") {
      $error = "Please fill in your email";
      break;
    } else 
if ($phone == "") {
      $error = "Please fill in your Phone number";
      break;
    } else
if ($studentid == "") {
      $error = "Please fill in your student Id";
      break;
    }
    //add new client to database
    // I Had to use a Dot and NOT a Comma to separate the Insert Statement
    // because I am using a MySQL Database and not a SQL Server Database
    $sql = "INSERT INTO student (First_Name, Last_Name, Email, Phone_Number, Student_ID)" .
      "VALUES ('$fname', '$lname', '$email', '$phone', '$studentid')";
    $result = $connection->query($sql);
    // Check if the query was successful
    if (!$result) {
      $error = "SQL Error ! " . $connection->error;
      break;
    }

    //We initialize the variables to be empty
    $fname = "";
    $lname = "";
    $email = "";
    $phone = "";
    $studentid = "";

    $success = "The Student has been saved Successfully ";

    //We redirect the user to the List of students page 

  } while (false);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Capture Student</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- Code For nev bar -->
   <style>
body {
      background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)), url("img/bg.jpg");
      height: 50%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }

.card {
      margin-right: auto;
      margin-left: auto;
      width: 250px;
      box-shadow: 0 15px 25px rgba(129, 124, 124, 0.2);
      height: 300px;
      border-radius: 5px;
      backdrop-filter: blur(14px);
      background-color: rgba(255, 255, 255, 0.2);
      padding: 10px;
      text-align: center;
    }

    .card img {
      height: 60%;
    }
    label{
       color: white;

    }
   </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/script.js"></script>
</head>

<body>
  <!-- Nav Bar -->
  <div class="topnav" id="myTopnav">
    <a href="home.php">Home</a>
    <a href="capture.php" class="active">Add Student</a>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
  </div>



  <h1 style="margin-left: 10%;"> <a href="index.php" style="color: white; "> Fiasco High School. </a></h1>
  <div class="container my-5" style="margin-left: 30%; margin-right: 20%;">
    <h1 style="margin-left: 5%; margin-right:auto ; color: white;">Create Student </h1>
    <!-- Here we display error message if the values are not filled  -->
    <?php
    if (!empty($error)) {
      echo '<div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
          <strong>Error!! </strong> ' . $error . '
        </div>';
    }
    ?>
    <form method="post">
      <!-- This is for the First Name   -->
      <div class="row">
        <div class="col-25">
          <label>First Name</label>
        </div>
        <div class="col-75">
          <input type="text" class="form-control" name="ifname" value="<?php echo $fname ?>" placeholder="Enter your first name" required />
        </div>
      </div>
      <!-- This is for the Last Name  -->
      <div class="row">
        <div class="col-25">
          <label>Last Name</label>
        </div>
        <div class="col-75">
          <input type="text" name="ilname" value="<?php echo $lname ?>" placeholder="Enter you last name" />
        </div>
      </div>
      <!-- This is for the Email -->
      <div class="row">
        <div class="col-25">
          <label>Email</label>
        </div>
        <div class="col-75">
          <input type="email" name="iemail" value="<?php echo $email ?>" placeholder="somthing@somthing.com" />
        </div>
      </div>
      <!-- This is for the Phone number  -->
      <div class="row">
        <div class="col-25">
          <label>Phone Number</label>
        </div>
        <div class="col-75">
          <input type="text" name="iphone" maxlength="12" value="<?php echo $phone ?>" placeholder="0123456789" />
        </div>
      </div>
      <!-- This is for the Student ID  -->

      <div class="row" style="margin-bottom: 10px;">
        <div class="col-25">
          <label>Student ID</label>
        </div>
        <div class="col-75">
          <input type="text" name="istudent" maxlength="8" value="<?php echo $studentid ?>" placeholder="M1234567" />
        </div>
      </div>
      <div class="row" style="margin-bottom: 10px;">
        <input type="submit" value="Add" />
      </div>
      <?php
      if (!empty($success)) {
        echo '<div class="alert success">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
          <strong>Success!!</strong> ' . $success . '
        </div>';
      }
      ?>
    </form>
  </div>

  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>
</body>

</html>