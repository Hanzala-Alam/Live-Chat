<?php 
    include("dbConnection.php");
    session_start();
    extract($_POST);

    if(isset($_POST['fetchNotyId'])){
        $id = $_POST['fetchNotyId'];
        $select = "select * from Messages where ReciverId = '$id'";
        $run = mysqli_query($con, $select);

        if(mysqli_num_rows($run)>0){
            while($result = mysqli_fetch_array($run)){
                $msg = $result['Message'];
                $rID = $result['ReciverId'];
                $sID = $result['SenderId'];
                
                
            }
            // while($result = mysqli_fetch_array($run)){
                // $msg = $result["Message"];
                // $rID = $result["ReciverId"];
                // $sID = $result["SenderId"];

                // $data = $id;
                
                // $selectSender = "select * from Person where Id= '$sID'";

                // $r = mysqli_query($con, $selectSender);
                // if(mysqli_num_rows($r)>0){
                //     $res = mysqli_fetch_array($r);
                //     $username = $res["Name"];
                //     $userImg = $res["Image"];

                //     $data="<div style='width:100%;display:flex;justify-content:center;border:solid 1px red'>
                //     <div style='width:100%;display:flex;border:solid 1px green;padding:5px'>
                //     <div style='padding:2px;width:100%;display:flex;border:solid 1px;align-items:center'>
                //     <div style='width:50px;height:50px;border:solid 1px;border-radius:50%;overflow:hidden'>
                //         <img src=".$userImg."  alt='no image' width='40' height='48'>
                //     </div>
                //     &nbsp;
                //     <div style='border:solid 1px pink;width:100%;'>
                //         <div style='width:100%;height:25px;border:solid 1px;font-size:16px;font-family:sanserif'><span style='color:balck'>User : </span><span style='color:#521729'>".$username."</span></div>
                //         <div style='width:100%;height:25px;border:solid 1px;font-family:sanserif'><span>Message :</span><span style='color:#521729'> ".$msg."</span></div>
                //     </div>
                    
                //     </div>
                //     </div>
                //     </div>";
                // }
            // }
            
            
        }
        // echo $data;
    }
?>