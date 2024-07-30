<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of students</title>
  <!-- Got my own unique kit from Font Awesome For Update and Delete Icon -->
  <script src="https://kit.fontawesome.com/db8dcf6454.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <style>
    body {
      background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)), url("img/bg.jpg");
      height: 50%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }
  </style>
  <script src="js/script.js">

  </script>
</head>

<body>
  <!-- Back Ground image  -->
  <div class="hero-image1">
    <!-- Nav Bar -->
    <div class="topnav" id="myTopnav">
      <a href="home.php" class="active">Home</a>
      <a href="capture.php">Add Student</a>
      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>

    <h1><a href="index.php" style="color: white; padding-left: 10%; ">FIASCO High School </a></h1>
    <!-- Table  -->

    <div class="container my-5" style="overflow-x:auto; margin-left: 20%; margin-right: 10%; ">
      <h3 style="color: white;"> This is a list of students <i>(Click on icon to delete or update)</i></h3>
      <table id="students" style="background-color: white;">
        <!-- Here we Create a header for our TABLE -->
        <thead>
          <tr>
            <th>Update</th>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Student ID</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // We need to first connect to the database
          // connecting to the database 
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "afribit";
          // Create connection
          $connection = new mysqli($servername, $username, $password, $dbname);

          //Check connection to database
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
          }
          //Read each row from database table
          $query = "SELECT * FROM student";
          $result = $connection->query($query);
          //check is SQl is executed correctly 
          if (!$result) {
            die("Cannot Read From Table. " . $connection->error);
          }
          //Display data from Each row to table in Website 
          while ($row = $result->fetch_assoc()) {
            echo " <tr>
    <td><a href='Update.php?id=$row[id]' > <i class='fa-solid fa-user-pen' style=' margin-left: 20px; font-size:30px;color: #4f7ecf;'></i></a></td>
    <td>$row[id]</td>
    <td>$row[First_Name]</td>
    <td>$row[Last_Name]</td>
    <td>$row[Email]</td>
    <td>$row[Phone_Number]</td>
    <td>$row[Student_ID]</td>
    <td ><a href='Delete.php?id=$row[id]' style='margin-left: 20px;'> <i class='fa fa-trash-o' style='font-size:30px;color:red'></i> </a> </td>
 </tr>";
          }

          ?>
        </tbody>

      </table>
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
  </div>
</body>

</html>