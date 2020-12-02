<?php 
    include("dbConnection.php");

    extract($_POST);

    if(isset($_POST['Id'])){
        $id = $_POST['Id'];
        $select = "select * from Person where Id = '$id'";
        $run = mysqli_query($con, $select);
        if(mysqli_num_rows($run)>0){
            $result = mysqli_fetch_array($run);
            $data="<div style='width:100%;display:flex;justify-content:center;'>
            <div style='width:200px;display:flex;justify-content:center;'>
            <div style='padding:2px;width:200px;'>
            <div style='width:70px;height:70px;margin:0 auto;border:solid 2px white;border-radius:50%;overflow:hidden'>
                <img src=".$result['Image']."  alt='no image' width='68' height='68'>
            </div>
            <div style='width:100%;height:25px;text-align:center;color:white;font-family:sanserif;font-size:18px;'>".$result['Name']."</div>
            </div>
            </div>
            </div>";
        }
        echo $data;
    }
?>