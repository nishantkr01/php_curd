<?php
    // $server_name="localhost";
    // $user_name="root";
    // $password="root";
    // $db_name="medical";

    // $conn = mysqli_connect($server_name,$user_name,$password,$db_name);
    // if(!$conn)
    // {
    //     echo "Error";
    // }
    // else{
       
    // }

$connection = pg_connect("host=localhost port=5432 dbname=testdb user=postgres password=postgres") or die("couldn't make a connection.");

?>