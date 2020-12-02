<?php 
    include("dbConnection.php");

    extract($_POST);

    if(isset($_POST["RId"])){
        $reciverId = $_POST["RId"];
        $senderId = $_POST["SId"];

        // echo "hanzala";
        $selectReciver = "select * from Person where Id = '$reciverId'";
        $rrun = mysqli_query($con, $selectReciver);
        if(mysqli_num_rows($rrun)>0){
            $rreslt = mysqli_fetch_array($rrun);
            $rname = $rreslt["Name"];
            $rimage = $rreslt["Image"];
        }
        $selectSender = "select * from Person where Id = '$senderId'";
        $srun = mysqli_query($con, $selectSender);
        if(mysqli_num_rows($srun)>0){
            $sreslt = mysqli_fetch_array($srun);
            $sname = $sreslt["Name"];
            $simage = $sreslt["Image"];
        }
        $select = "select * from Messages where SenderId = '$senderId' and ReciverId='$reciverId' or SenderId = '$reciverId' and ReciverId = '$senderId'";

        $run = mysqli_query($con, $select);
        if(mysqli_num_rows($run)>0){
            while($res = mysqli_fetch_array($run)){
                $msg = $res["Message"];
                if($res["SenderId"]== $senderId && $res["ReciverId"]== $reciverId){
                    
                    $data="<div style='width:250px;height:90px;padding:5px;float:left'>
                        <div style='display:flex'>
                            <div>
                                <div style='width:55px;height:55px;border-radius:50%;display:flex;justify-content:center;align-items:center;background:#73d1ce;overflow:hidden'>
                                    <img src=".$simage." height='55' width='55'>
                                </div> &nbsp;
                                <p class='user-name' style='color:white'>".$sname."</p>
                            </div>
                            <div style='width:100%;padding:5px;vertical-align:middle;text-align:left;color:white'>
                                $msg
                            </div>
                        </div>
                    </div>";
                    echo $data;
                }
                else if($res["SenderId"] == $reciverId && $res["ReciverId"]== $senderId){
                    $data="<div style='width:250px;height:90px;padding:5px;float:right'>
                        <div style='display:flex'>
                            <div style='width:100%;padding:5px;vertical-align:middle;text-align:right;color:white'>
                                $msg
                            </div>
                            <div>
                                <div style='width:55px;height:55px;border-radius:50%;display:flex;justify-content:center;align-items:center;background:#73d1ce;overflow:hidden;'>
                                   <img src=".$rimage." height='55' width='55'>
                                </div> &nbsp;
                                <p class='user-name' style='color:white'>".$rname."</p>
                            </div>
                        </div>
                    </div>";
                    echo $data;
                }
            }
        }
        
    }
?>