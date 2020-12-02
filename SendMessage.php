<?php 
    include("dbConnection.php");

    extract($_POST);

    if(isset($_POST["ReciverId"])){
        $reciverId = $_POST["ReciverId"];
        $senderId = $_POST["SenderId"];
        $message = $_POST["msg"];

        $insert = "insert into Messages(SenderId,ReciverId,Message)values('$senderId','$reciverId','$message')";

        $run = mysqli_query($con, $insert);        
    }
?>