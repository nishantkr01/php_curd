<?php

        include_once 'database.php';
        $stud_id = $_GET["userid"];
?>




<?php

$sql = "DELETE FROM stud_regd WHERE stud_id=$stud_id";
if (pg_query($connection, $sql)) {
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
