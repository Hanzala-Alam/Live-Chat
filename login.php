<?php 
    include("dbConnection.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 m-auto">
                <br><br><br>
                <div style="padding:10px;">
                    <h3 style="font-family: 'Times New Roman';text-align:center">LOGIN FORM</h3>
                </div>
                <form action="" method="POST">
                    <div style="display:flex;width:320px;">
                        <input type="text" name="email" required placeholder="Email" class="form-control" style="width:270px;">
                    </div>
                    <br>
                    <div style="display:flex;width:320px;align-items:center">
                        <input type="password" name="password" required placeholder="Password" class="form-control" style="width:270px;" id="pass_">
                        &nbsp;
                        <div style="position:relative;width:31px;height:28px">
                            <input type="checkbox" onclick="ShowPassword()" style="width:30px;height:25px;opacity:0;position:absolute;">
                            <i class="fa fa-eye-slash" aria-hidden="true" style="font-size:20px;" id="showAttr"></i>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="loginBtn" value="Log In" class="btn btn-info">
                    <a href="signup.php" class="btn btn-dark">Register</a>
                </form>
            </div>
        </div>
    </div>
    
    <?php
        if(isset($_POST['loginBtn'])){
            $email = $_POST["email"];
            $password = $_POST["password"];

            $select = "select * from person where email = '$email' and Password = '$password'";

            $run = mysqli_query($con, $select);
            $fetchData = mysqli_fetch_array($run);
            if($fetchData > 0){
                $fetchData["Name"];
                $_SESSION["userId"] = $fetchData["Id"];
                $_SESSION["username"] = $fetchData["Name"];
                header("location:home.php");
            }
            else{
                echo "<script>alert('Username And Password Invalid')</script>";
            }
        }
    ?>
    <script>
        var pass = document.getElementById("pass_");
        var showAttr_ = document.getElementById("showAttr");
        function ShowPassword(){
            if(pass.type == "password"){
                pass.type = "text";
                showAttr_.className = "fa fa-eye";
            }
            else{
                pass.type = "password";
                showAttr_.className = "fa fa-eye-slash";
            }
            // alert("as");
        }
    </script>
    <script herf="js/bootstrap.min.js"></script>
</body>
</html>