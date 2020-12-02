<?php
    include("dbConnection.php");

    extract($_POST);

    if(isset($_POST["reciverId"])){
        $rId =  $_POST["reciverId"];
        $sId = $_POST["senderId"];

        $delete = "delete from Messages where ReciverId = '$rId' and SenderId = '$sId' or ReciverId = '$sId' and SenderId = '$rId'";

        mysqli_query($con, $delete);
    }

?>