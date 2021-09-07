<?php

        include_once 'database.php';
        $stud_id = $_GET["userid"];
        $stud_photo = $_GET["photo"];
?>




<?php

$sql = "DELETE FROM stud_regd WHERE stud_id=$stud_id";
if (pg_query($connection, $sql)) {
    
    unlink("image/".$stud_photo);
   ?>
    <script>
                alert("Deleted Successfully");
                
                window.location.href = "studentDetails.php";
    </script>
   <?php
} else {
    echo "Error deleting record: " . pg_error($connection);
}
pg_close($connection);

?>
