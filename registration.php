<?php

include_once "database.php";
if (isset($_POST['submit'])) {
    $regDate =$_POST['regDate'];
    $stud_name =$_POST['stud_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $stud_mobile = $_POST['stud_mobile'];
    
   

    //Photo


    $filename = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];    
        $folder = "image/".$filename;
          

  
        // Get all the submitted data from the form
        // $sql = "INSERT INTO image (filename) VALUES ('$filename')";
  
        // Execute query
     
          
        // Now let's move the uploaded image into the folder: image
            move_uploaded_file($tempname, $folder);
           
  
    //Photo End
   
    
  


        $insertPatient = "insert into stud_regd(stud_regd_date,stud_name, stud_dob, stud_gender, stud_mobile, stud_photo) values('$regDate','$stud_name','$dob','$gender','$stud_mobile','$filename')";
        // print_r($insertPatient);
        // exit;

        $iquery = pg_query($connection, $insertPatient);
        if ($iquery) {
        ?>
            <script>
                alert("Registerd Successfully");

                window.location.href = "studentDetails.php";
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Registration Failed");
            </script>
<?php
        }
    }
else {
    
}



?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Student Registration</title>

    <style>
        .jumbotron{
            color: #ffff;
            background-color: #000 !important;
           
          }
          body {
            background-color: lightblue;
          }
    </style>
  </head>
  <body>
  <?php include 'header.php';?>

    <div class="container">
   
      <div class="jumbotron ">
      
      

       <h3>Student Registration</h3>


         <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
     
            <div class="form-group">
              <label for="dateId">Registration Date</label>
              <input type="date" class="form-control" id="dateId" name="regDate"  required>
            </div>

            <div class="form-group">
              <label for="nameId">Student Name</label>
              <input type="text" class="form-control" id="nameId" name="stud_name" placeholder="ex: Nishant Kumar" required>
            </div>

            <div class="form-group">
              <label for="dobId">Date Of Birth</label>
              <input type="date" class="form-control" id="dobId" name="dob"  required>
            </div>

            <div class="form-check">
                <label >Gender</label>  &nbsp; &nbsp; &nbsp;
                <input class="form-check-input" type="radio" name="gender"  value="male">
                <label class="form-check-label" for="exampleRadios1">
                    Male
                </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <input class="form-check-input" type="radio" name="gender"  value="female">
                <label class="form-check-label" for="exampleRadios1">
                    Female
                </label>
            </div>

            <div class="form-group">
              <label for="mobileId">Mobile Number</label>
              <input type="text" class="form-control" id="mobileId" name="stud_mobile" placeholder="ex : 9898989898" required>
            </div>

            <div class="form-control">
                <input type="file" name="photo" class="form-control-file" id="customFile" required>
                
            </div>
            <br>
  
            <button type="submit" name="submit" class="btn btn-primary form-control">Submit</button> <br><br>
            <button type="reset" class="btn btn-secondary form-control">Reset</button><br>
         </form><br>
         <a href="studentDetails.php" class="btn btn-warning form-control">Go to Details Page</a> 
       </div>
    </div>

    <?php include 'footer.php';?>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>