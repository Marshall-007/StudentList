<?php
// connecting to the database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "afribit";
// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);


$id = "";
$fname = "";
$lname = "";
$email = "";
$phone = "";
$studentid = "";

$error = "";
$success = "";

// Check with Get Method 
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // check if id of student sexist or not 
    if (!isset($_GET['id'])) {
        //reditect to the Home page 
        header('Location: home.php');
        exit;
    }

    $id = $_GET["id"];
    //Reading form database table 
    $query = "SELECT * FROM student WHERE id = '$id'";
    $result = mysqli_query($connection, $query);
    $row = $result->fetch_assoc();
    //Check if its not empty 

    if (!$row) {
        header('Location: home.php');
        exit;
    }
    //Read data from database 
    $fname = $row['First_Name'];
    $lname = $row['Last_Name'];
    $email = $row['Email'];
    $phone = $row['Phone_Number'];
    $studentid = $row['Student_ID'];
} else {
    
   
        // Get the posted values
        $id = $_POST["id"];
        $fname = $_POST["ifname"];
        $lname = $_POST["ilname"];
        $email = $_POST["iemail"];
        $phone = $_POST["iphone"];
        $studentid = $_POST["istudent"];
        
        // Check with Post Method  
        do {
            //check if all fields are filled.
            if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($studentid)){
                $error = "Please fill all fields.";
                break;
            }
            $sql = " UPDATE student".
            " SET First_Name = '$fname', Last_Name = '$lname', Email = '$email', Phone_Number = '$phone', Student_ID = '$studentid'".
            " WHERE id = '$id'";
            $result = mysqli_query($connection, $sql);
            if (!$result) {
                $error = "Error Cannot Update user : " . $connection->error;
                break;
                }
                $success = "User Updated Successfully";

                // redirect the admin
                header('Location: home.php');
                exit;





            
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body {
      background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)), url("img/bg.jpg");
      height: 50%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }
    label{
        color: white;
    }
  </style>
    <script src="js/script.js"></script>
</head>

<body>
    <!-- Nav Bar -->
    <div class="topnav" id="myTopnav">
        <a href="home.php">Home</a>
        <a href="capture.php" class="active">Add Student</a>
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>



    <h1 style="margin-left: 10%; color: white;">Fiasco High School. </h1>
    <div class="container my-5" style="margin-left: 20%; margin-right: 20%;">
        <h1 style="margin-left: 35%; margin-right: 35%; color: white;">Update Student Details </h1>
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
            <!-- Store the id of the Student -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                <input type="submit" value="Update" />
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