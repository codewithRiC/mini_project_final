<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bussiness_Accounting</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
     <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div style="width: 100%">
            <div class="Rectangle-2">
                <div class="login_header_1">Welcome Back!</div>
                <div class="login_header_2">Login to your account and start managing products.</div>
                
            </div>
            <div class="Rectangle-1">
                <div class="logo">
                    <div class="lo">
                      <img src="css/logo.png" alt="Logo"  class="SDS-Next-Logo">
                    </div>
                    <div class="he">  
                      <h2><emp>U</emp>ltimate  <emp>M</emp>arketing  <emp>S</emp>olution</h2>
                    </div>  
                </div>
                <form action="" method="post">
                <div class="login_header_3">Username</div><input id="login_form:j_idt10" name="username" type="text" autocomplete="off" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all input-box" role="textbox" aria-disabled="false" aria-readonly="false">
                <div class="login_header_3">Password</div><input id="login_form:j_idt12" name="password" type="password" autocomplete="off" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all input-box" role="textbox" aria-disabled="false" aria-readonly="false">
                <div id="login_form:j_idt19" class="ui-messages ui-widget" style="margin-left: 10%; margin-right: 10px" aria-live="polite"></div>
                <button id="login_form:login1" name="login_form:login1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-left loginButton input-button" onclick="PrimeFaces.bcn(this,event,[function(event){jQuery(this).addClass('ui-state-disabled');jQuery('.passwordid').addClass('ui-state-disabled');jQuery('.passwordid').prop('disabled', true);},function(event){PrimeFaces.ab({s:&quot;login_form:login1&quot;,u:&quot;login_form:captcheGrid login_form&quot;});return false;}]);" type="submit" role="button" aria-disabled="false"><span class="ui-button-icon-left ui-icon ui-c fa fa-sign-in"></span><span class="ui-button-text ui-c">Login</span></button>
                <div style="margin-top: 10%; width: 100%; text-align: center;"><a id="login_form:j_idt21" href="signup.php" class="ui-commandlink ui-widget Forgot-Password" onclick="PrimeFaces.addSubmitParam('login_form',{'login_form:j_idt21':'login_form:j_idt21'}).submit('login_form');return false;PrimeFaces.onPost();" style="font-family: sans-serif;">New Registration</a>
                </form>
                </div>
                <div style="position: absolute;bottom: 0;right: 0;left: 0; margin: auto;">
                    <span style="float: right;font-family:'Open Sans', sans-serif;font-size:12px; color:#565656;margin-right: 7%">
                        © 2023. Rishi Software. All rights reserved. 
                    </span>
                </div>
            </div>
        </div>
    

   
</body>
</html>

<?php
include('connection.php');

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM signup WHERE username='$username' && password='$password';";
    $result = mysqli_query($conn, $query); // Execute the query
    $data = mysqli_fetch_assoc($result);
    if ($result) {
        $total = mysqli_num_rows($result);

        if ($total == 1) {
            session_start();
            $_SESSION['username'] = $data['username'];
            header("location:home.php");
        } else {
            echo "<script>alert('Login Failed! Wrong email or password');</script>";
            echo "Login failed";
        }
    } else {
        echo "Query execution failed: " . mysqli_error($conn);
    }
}
?>



