<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ret.css">
    <link rel="stylesheet" href="css/home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Credit Debit</title>

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
   <?php 
    $server = "localhost";
    $username = "root";
    $password = "";
    $database="mini";
  
    // Create a database connection
    $con = mysqli_connect($server, $username, $password,$database);
  
    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
   ?>
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
    <?php 
    if(isset($_GET['trans_id'])){
        $trans_id = $_GET['trans_id'];
        $query1  = "SELECT retailer.shop_name
        FROM transaction
        INNER JOIN retailer ON transaction.sno=retailer.sno where transaction.trans_id='$trans_id'";
         $result1 =  mysqli_query($con,$query1);
         $data1 = mysqli_fetch_assoc($result1);

        $query = "SELECT * FROM `transaction` WHERE trans_id='$trans_id' ";
       $result =  mysqli_query($con,$query);
       $data = mysqli_fetch_assoc($result);

    

?>

    <div class="rect2">
        <section class="dash" id="dash">
            <div class="header">
                <h1 > Shop : <span><?php echo $data1['shop_name']; ?></span></h1>
            </div>
            <div class="add">
                <h2>Edit CREDIT / DEBIT</h2>
                <form action="" method="POST" id="retadd" onsubmit="return check();">
                <label for="ret_type">Transaction Type:</label>
                    <select name="trans_type" id="trans_type">
                        <option value="" disabled>Transaction Type</option>
                        <option value="Credit" <?php $data['trans_type']=='Credit' ? "selected"  : " "?>>Credit</option>
                        <option value="Debit" <?php $data['trans_type']=='Debit' ? "selected"  : " "?>>Debit</option>
                        
                    </select>

                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" value="<?php echo $data['amount']; ?>" />

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="<?php echo $data['date'];?>" />
        

                    <label for="bill_no">Bill No:</label>
                    <input type="text" id="bill_no" name="bill_no" value="<?php echo $data['bill_no']; ?>" >
                    <label for="remark">Remark:</label>
                    <textarea name="remark" id="remark" cols="30" rows="10"><?php echo $data['remark']; ?></textarea>
                    <div class="btn">
                   <button type="submit" name="update">Update</button>
                    
                    <a href="trans_edit.php?ret_id=<?php echo $data['sno']?>"><i class="fa-solid fa-backward"></i></a>
                    </div>
                 </form>
         <?php } ?>       
             </div>
      </section>
    </div>
</div>   
</body>
</html>


<?php

//include('connection.php');

if(isset($_POST['update'])){
    $trans_type = $_POST['trans_type'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $bill_no = $_POST['bill_no'];
    $remark = $_POST['remark'];
    $trans_id = $_GET['trans_id'];

  
    $sql = "UPDATE  `transaction` SET `amount`= '$amount', `date`='$date', `bill_no`=' $bill_no', `trans_type`='$trans_type', `remark`='$remark' WHERE trans_id='$trans_id'" ;
   
    if($con->query($sql) === true){
        
       // echo "<script>alert ('Successfully Updated')</script>";
        //session_start();
        // $_SESSION["username"] = $username;
    //   header('location:trans.php');
        // exit();
        // $conn->close();
    }else{
        echo "ERROR: $sql <br> $conn->error";
    }

    
}

?>

