<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ret.css">
    <link rel="stylesheet" href="css/home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Retailer Addition</title>

    <script>
        function check() {
            // var password = document.getElementById('password').value;
            // var confirmPassword = document.getElementById('conpassword').value;
            var phn =document.getElementById('ret_phn').value;

            // if (password !== confirmPassword) {
            //     alert('Password and Confirm Password do not match');
            //     return false;
            // }
            if(phn.length!=10){
                alert('Phone number is invalid');
                return false;
            }

            return true;

        }
    </script>
</head>
<body>
   
    <!-- Header seaction -->

    <?php include('include/header.php') ?>
   

    <!-- side rectangle  -->
<div class="total">
    <div class="rect1">
        <section class="head">
            <div class="profile-logo">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="username">
                <h1>UTKAL AGENCY</h1>
            </div>
         

        </section>
        
        <div class="menubar">
            <i class="fa-solid fa-circle-dot"></i>
            <a href="home.php">HOME</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="retailer.php" style="color:blue">RETAILERS</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="transaction.php">CREDIT/DEBIT</a>
            
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="report.php">REPORTS</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="about.php">ABOUT US</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="contact.php">CONTACT US</a>
            <br><br><br>
        </div>


    </div>

    <!-- right side recatngle -->


    <div class="rect2">
        <section class="dash" id="dash">
            <div class="header">
                <h1 > New<span>RETAILER</span></h1>
            </div>
            <div class="add">
                <h2>ADDITION OF RETAILER</h2>
                <form action="#" method="post" id="retadd" onsubmit="return check();">
                    <label for="ret_name">Retailer Name:</label>
                    <input type="text" id="ret_name" name="ret_name" required>

                    <label for="shop_name">Counter Name:</label>
                    <input type="text" id="shop_name" name="shop_name" required>

                    <label for="ret_add">Address:</label>
                    <textarea name="ret_add" id="ret_add" cols="5" rows="3" required></textarea>
        

                    <label for="ret_phn">Phone Number:</label>
                    <input type="number" id="ret_phn" name="ret_phn" required>

                    <label for="ret_type">Retailer Type:</label>
                    <select name="ret_type" id="ret_type">3
                        <option value="Grocery small">Grocery Small</option>
                        <option value="Grocery larger">Grocery large</option>
                        <option value="Pan plus">Pan Plus</option>
                        <option value="Bakery">Bakery</option>
                        <option value="Wholeseller">Wholeseller</option>
                        <option value="Chemist">Chemist</option>
                        
                    </select>
                    <div class="btn">
                    <button type="submit">Submit</button>
                    <a href="retailer.php"><i class="fa-solid fa-backward"></i></a>
                    </div>
                 </form>
                
             </div>
      </section>
    </div>
</div>   
</body>
</html>


<?php

include('connection.php');

if(isset($_POST['ret_name'])){
    $ret_name = $_POST['ret_name'];
    $shop_name = $_POST['shop_name'];
    $ret_add = $_POST['ret_add'];
    $ret_phn = $_POST['ret_phn'];
    $ret_type=$_POST['ret_type'];

    $sql = "INSERT INTO `retailer`(`ret_name`, `shop_name`, `ret_add`,`ret_phn`,`ret_type`) VALUES ('$ret_name','$shop_name','$ret_add','$ret_phn','$ret_type');";
   
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

