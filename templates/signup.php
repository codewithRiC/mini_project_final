<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bussiness_Accounting</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="css/signup.css">

     <script>
        function check() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('conpassword').value;
            var phn =document.getElementById('phn').value;

            if (password !== confirmPassword) {
                alert('Password and Confirm Password do not match');
                return false;
            }
            if(phn.length!=10){
                alert('Phone number is invalid');
                return false;
            }

            return true;

        }
    </script>
</head>
<body>
    <div style="width: 100%">
            <div class="Rectangle-2">
                <div class="login_header_1">Ulimate Marketing Solution</div>
                <div class="login_header_2">Login to your account and start managing products.</div>
                
            </div>
            <div class="Rectangle-1">
                <div>
                    <div class="he">  
                      <h2>New Registration</h2>
                    </div>  
                 <div>
                     
                   <form action="" method="post"  onsubmit="return check();">
                   <div class="login_header_3">Email</div><input id="email" name="email" type="email" autocomplete="off" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all input-box" role="textbox" aria-disabled="false" aria-readonly="false" required>   
                    <div class="login_header_3">Username</div><input id="uname" name="username" type="text" autocomplete="off" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all input-box" role="textbox" aria-disabled="false" aria-readonly="false" required>
                    <div class="login_header_3">Password</div><input id="password" name="password" type="password" autocomplete="off" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all input-box" role="textbox" aria-disabled="false" aria-readonly="false" required>
                    <div class="login_header_3">Confirm Password</div><input id="conpassword" name="conpassword" type="password" autocomplete="off" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all input-box" role="textbox" aria-disabled="false" aria-readonly="false" required>
                    <div class="login_header_3">Phone Number</div><input id="phn" name="phn" type="phone" autocomplete="off" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all input-box" role="textbox" aria-disabled="false" aria-readonly="false" required>
                    <div id="login_form:j_idt19" class="ui-messages ui-widget" style="margin-left: 10%; margin-right: 10px" aria-live="polite"></div>
                    <button id="login_form:login1" name="login_form:login1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-left loginButton input-button" onclick="PrimeFaces.bcn(this,event,[function(event){jQuery(this).addClass('ui-state-disabled');jQuery('.passwordid').addClass('ui-state-disabled');jQuery('.passwordid').prop('disabled', true);},function(event){PrimeFaces.ab({s:&quot;login_form:login1&quot;,u:&quot;login_form:captcheGrid login_form&quot;});return false;}]);" type="submit" role="button" aria-disabled="false"><span class="ui-button-icon-left ui-icon ui-c fa fa-sign-in"></span><span class="ui-button-text ui-c">SignUp</span></button>
                    <div class="login_header_3"><a href="login.php" style="text-decoration:none; text-align:center; color:dark blue;">Back to login</a></div>
                   </form>
                 </div> 
                </div>
                <div style="position: absolute;bottom: 0;right: 0;left: 0; margin: auto;">
                    <span style="float: right;font-family:'Open Sans', sans-serif;font-size:12px; color:#6e0f0f;margin-right: 7%">
                        © 2023. Rishi Software. All rights reserved. 
                    </span>
                </div>
            </div>
     </div>
    

   
</body>
</html>

<?php

include('connection.php');

if(isset($_POST['email'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];
    $phn=$_POST['phn'];

    $sql = "INSERT INTO `signup`(`email`, `password`, `conpassword`,`username`,`phn`) VALUES ('$email','$password','$conpassword','$username','$phn');";
   
    if($conn->query($sql) === true){
        
        echo "<script>alert ('Successfully stored')</script>";
        //session_start();
        // $_SESSION["username"] = $username;
        // header('location:index.php');
        // $conn->close();
    }else{
        echo "ERROR: $sql <br> $conn->error";
    }

    
}

?>

