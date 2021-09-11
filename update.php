<?php

include_once "database.php";
if (isset($_POST['submit'])) {
  $regDate = $_POST['regDate'];
  $stud_name = $_POST['stud_name'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $stud_mobile = $_POST['stud_mobile'];
  $stud_id = $_POST['stud_id'];


  //Photo
  // if(isset($name['photo']))
  // {
  //     echo "hiiii";
  //     exit;
  // }

  $new_image = $_FILES["photo"]["name"];
  $old_image = $_POST["photo_old"];

  if ($new_image !== '') {
    $filename = $_FILES["photo"]["name"];
    unlink("image/" . $old_image);
  } else {
    $filename = $old_image;
  }

  $tempname = $_FILES["photo"]["tmp_name"];
  $folder = "image/" . $filename;



  // Get all the submitted data from the form
  // $sql = "INSERT INTO image (filename) VALUES ('$filename')";

  // Execute query


  // Now let's move the uploaded image into the folder: image
  move_uploaded_file($tempname, $folder);


  //Photo End


  if (!preg_match('/^[0-9]{10}+$/', $stud_mobile)) {
?>
    <script>
      alert("Invalid Phone Number !!!")
    </script>
    <?php

  } else {


    $insertPatient = "update stud_regd set stud_regd_date='$regDate',stud_name='$stud_name', stud_dob='$dob', stud_gender='$gender', stud_mobile='$stud_mobile', stud_photo='$filename' where stud_id='$stud_id'";
    // print_r($insertPatient);
    // exit;

    $iquery = pg_query($connection, $insertPatient);
    if ($iquery) {
    ?>
      <script>
        alert("Updated Successfully");

        window.location.href = "studentDetails.php";
      </script>
    <?php
    } else {
    ?>
      <script>
        alert(" Failed");
      </script>
<?php
    }
  }
} else {
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
</head>

<style>
  .jumbotron {
    color: #ffff;
    background-color: #000 !important;
  }

  body {
    background-color: lightblue !important;
  }
</style>

<body>

  <?php include 'header.php'; ?>
  <?php
  include_once 'database.php';
  $stud_id = $_GET["userid"];

  $getData = "select * from stud_regd where stud_id=$stud_id";
  $updateQuery = pg_query($connection, $getData)  or die("Cannot execute query: $query\n");
  $row = pg_fetch_assoc($updateQuery);
  ?>

  <div class="container">
    <div class="jumbotron">

      <h3>Student Upate</h3>
      <div style="cursor:pointer; height: 100px; width: 100px; border-radius: 50px; border-width: 4px;  border-style: solid;">
        <img data-toggle="modal" data-target="#exampleModal" style="  width: 100%; height: 100%; border-radius: 50px; overflow: hidden;" src="image/<?php echo $row['stud_photo']; ?>">
      </div>
      <br>


      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="easyzoom easyzoom--overlay"> <a href="image/<?php echo $row['stud_photo']; ?>"> <img class="mainimage" style="  width: 470px; height: 470px;  overflow: hidden;" src="image/<?php echo $row['stud_photo']; ?>" height="460" /> </a> </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="stud_id" value="<?php echo $row['stud_id'] ?>">
        <div class="form-group">
          <label for="dateId">Registration Date</label>
          <input type="date" class="form-control" value="<?php echo $row['stud_regd_date'] ?>" id="dateId" name="regDate" placeholder="date">
        </div>

        <div class="form-group">
          <label for="nameId">Student Name</label>
          <input type="text" class="form-control" id="nameId" value="<?php echo $row['stud_name'] ?>" name="stud_name" placeholder="name">
        </div>

        <div class="form-group">
          <label for="dobId">Date Of Birth</label>
          <input type="date" class="form-control" id="dobId" value="<?php echo $row['stud_dob'] ?>" name="dob" placeholder="date of birth">
        </div>


        <?php
        $gender = $row['stud_gender'];


        ?>
        <div class="form-check">
          <label>Gender</label> &nbsp; &nbsp; &nbsp;
          <input class="form-check-input" type="radio" name="gender" value="male" <?php if ($gender != "female") echo "checked"; ?>>
          <label class="form-check-label" for="exampleRadios1">
            Male
          </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <input class="form-check-input" type="radio" name="gender" value="female" <?php if ($gender == "female") echo "checked"; ?>>
          <label class="form-check-label" for="exampleRadios1">
            Female
          </label>
        </div>

        <div class="form-group">
          <label for="mobileId">Mobile Number</label>
          <input type="text" class="form-control" id="mobileId" value="<?php echo $row['stud_mobile'] ?>" name="stud_mobile" placeholder="Mobile Number">
        </div>

        <div class="custom-file">
          <input type="file" name="photo" class="form-control-file" id="customFile">
          <input type="hidden" name="photo_old" value="<?php echo $row['stud_photo'] ?>">
        </div>
        <br><br>

        <button type="submit" name="submit" class="btn btn-primary form-control">Update</button>
      </form>
      <a href="studentDetails.php" class="btn btn-warning form-control">Back To Details</a>

    </div>
  </div>
  <?php include 'footer.php'; ?>




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>