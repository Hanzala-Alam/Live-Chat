<?php 
    include("dbConnection.php");
    session_start();
    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        header("location:login.php");
    }
    $userId = $_SESSION["userId"];
    $select = "select * from person where Id = '$userId'";

    $run = mysqli_query($con, $select);
    if(mysqli_num_rows($run)>0){
        $result = mysqli_fetch_array($run);
        $img = $result['Image'];
    }

    $select2 = "select * from person where not Id = $userId";

    $run2 = mysqli_query($con, $select2);
    // if(mysqli_num_rows($run2)>0){
    //     $result2 = mysqli_fetch_array($run2);        
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cssfilea.css">

    <style>
        input[type="checkbox"]{
            width:20px;
            height:20px;
            z-index:1;
            position:absolute;
            opacity:0;
            cursor:pointer;
        }

        input[type="checkbox"]:checked ~ .dot-menu{
            display:block;
        }

        .dot-menu{
            background:white;
            position:absolute;
            top:30px;right:25px;
            padding:10px 25px 10px 25px;
            display:none;
        }
    </style>
</head>
<body>
    <nav class="navbar bg-dark navbar-dark fixed-top" >
        
        <div style="padding:2px;width:200px;display:flex;align-items:center;">
            <div style="width:50px;height:50px;border:solid 1px white;border-radius:50%;overflow:hidden">
                <img src="<?php echo $img ?? '' ?>"  alt="no image" width="48" height="48">
            </div>
            <div style="margin-left:15px;vertical-align:middle;height:23px">
                <p style="color:white;font-size:12px;text-align:center">Welcome <?php echo $_SESSION["username"]?></p>
            </div>
        </div>

        <select class="form-control" style="width:250px;margin-left:-300px" id='su'>
            <option value=""> -- Select User -- </option>
            <?php while($re = mysqli_fetch_assoc($run2)){ echo "<option value=".$re['Id'].">".$re['Name']."</option>";} ?>
        </select>
        <div style="position: relative;border:solid 1px">
            <div style="width:250px;min-height:300px;max-height:400px;border:solid 1px;top:40px;left:-200px;display:none;" id="notyCon" class="position-absolute rounded-top bg-white"></div>
        </div>        
    </nav>
    
    <br><br><br>
    <div class="container">
        
        <div class="row">
            <div class="col-md-5 m-auto">
                <div style="border:solid 2px black;height:540px;background:url('images/chatground.jpg');background-size:cover;margin-top:10px;" class="rounded-top">
                    <div style="width:100%;height:40px;position:reletive;border:solid 2px white" class="rounded-top">

                        <div style="width:40px;height:40px;position:absolute;right:20px;display:flex;justify-content:center;align-items:center">
                            <input type="checkbox" >
                            <i class="fa fa-ellipsis-v" style="color:white;font-size:20px;cursor:pointer" aria-hidden="true"></i>
                            <div style=""  class="rounded-top dot-menu">
                                <a href="#" id="clr" style="color:black;text-align:center;font-family:suie geo">Clear</a>
                            </div>
                        </div>
                    </div>
                    <div style="border:solid 2px white;height:450px;overflow:auto;" class="rounded-top" id="form2">
                    
                    </div>
                    <div style="display:flex;padding:5px;">
                        <input type="text" name="" class="form-control" placeholder="Type Message Here" style="width:300px;" id="msg_" require>
                        &nbsp;
                        <input type="submit" value="Send" class="btn btn-info" id="sendBtn">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    </script>

    <script>
        $(document).ready(function(){
            setInterval(function(){ ContentMessage2(); },3000)
            $("#sendBtn").on("click",function(){
                SendMessage();
                ContentMessage();
            });

            $("#clr").on("click",function(){
                ClearChat();
            });

            $("#msg_").on("keypress", function(){
                if(event.keyCode == 13){
                    SendMessage();
                    ContentMessage();                    
                }                
            });
            
            $("#su").change(function(){
                ContentMessage();
            });

            function UserInfo(){
                var Id = $("#su").val();
                $.ajax({
                    url:'userfatch.php',type:'post',
                    data:{Id:Id},success:function(data,status){
                        $("#form2").html(data);
                    }
                });
            }

            function ContentMessage(){
                var RId = $("#su").val();
                var SId = <?php echo $userId; ?>;
                $.ajax({
                    url:'MessageContainer.php',
                    type:'POST',
                    data:{RId:RId,SId:SId},
                    success: function(data,status){
                        $("#form2").html('');
                        $("#form2").append(data);
                        $("#form2").scrollTop($("#form2")[0].scrollHeight);
                    }
                });
            }

            function ContentMessage2(){
                var RId = $("#su").val();
                var SId = <?php echo $userId; ?>;
                $.ajax({
                    url:'MessageContainer.php',
                    type:'POST',
                    data:{RId:RId,SId:SId},
                    success: function(data,status){
                        $("#form2").html('');
                        $("#form2").append(data);
                    }
                });
            }

            function SendMessage(){
                var ReciverId = $("#su").val();
                var SenderId = <?php echo $userId; ?>;
                var msg = $("#msg_").val();
                if(ReciverId == null || ReciverId == ''){
                    alert('please select User First');
                }
                else{
                    if(msg == "" || msg == null){
                        alert("Please Type Message First");
                    }
                    else{
                        $.ajax({
                            url: 'SendMessage.php',
                            type: 'POST',
                            data: {ReciverId:ReciverId,SenderId:SenderId,
                                msg:msg
                            },
                            success: function(data,status){
                                $("#msg_").val('');
                            }
                        });
                    }
                }
            }

            function ClearChat(){
                reciverId = $("#su").val();
                senderId = <?php echo $userId?>;
                if(reciverId == null || reciverId == ""){
                    alert("Please Select User First");
                }
                else{
                    $.ajax({
                        url:'Clear.php',type:'POST',
                        data:{reciverId:reciverId,senderId:senderId},
                        success: function(data,status){
                            ContentMessage();
                        }
                    });
                }
            }
        });        
    </script>
</body>
</html>