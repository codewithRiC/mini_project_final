<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "mini";

// Create a database connection
$con = mysqli_connect($server, $username, $password, $database);

// Check the connection


// Close the database connection

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ret.css">
    <link rel="stylesheet" href="css/home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Retailer Edition/Remove</title>
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
                <h1 > Edit<span>RETAILER</span></h1>
            </div>
            <?php
        // Retrieve record from database
        if(isset($_GET['sno'])){
            $sno = $_GET['sno'];
        
            // Retrieve record from database
            $sql = "SELECT * FROM `retailer` WHERE `sno`='$sno'";
            $result = mysqli_query($con, $sql);
        
            // Check if the query was successful
            if($result){
                // Check if the result set is not empty
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
        
                    // Prepopulate form fields with record's values
                    $ret_name = $row['ret_name'];
                    $shop_name = $row['shop_name'];
                    $ret_add = $row['ret_add'];
                    
                    $ret_phn = $row['ret_phn'];
                    $ret_type = $row['ret_type'];
                } else {
                    // Handle empty result set
                    echo "No records found.";
                }
            } else {
                // Handle query error
                echo "Error: " . mysqli_error($con);
            }
        }
    ?>
    <div class="container">
      
        <p>Please update the details </p>
        
       
        <form action="" method="POST">
    <!-- <input type="hidden" name="sno" value="//"> -->
    <input type="text" name="ret_name" id="ret_name" value="<?php echo $ret_name; ?>">
    <input type="text" name="shop_name" id="shop_name" value="<?php echo $shop_name; ?>">
    <input type="text" name="ret_add" id="ret_add" value="<?php echo $ret_add; ?>">

    <input type="phone" name="ret_phn" id="ret_phn" value="<?php echo $ret_phn; ?>">
    <textarea name="ret_type" id="ret_type" cols="30" rows="10"><?php echo $ret_type; ?></textarea>
    <div class="btn">
       <button class="btn" type="submit" name="update">Update</button>
       <a href="retailer.php"><i class="fa-solid fa-backward"></i></a>
    </div>
</form>
    </div>
            
      </section>
    </div>
</div>  
<?php 
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_POST['update'])) {
        // Collect post variables and sanitize input
        $ret_name = mysqli_real_escape_string($con, $_POST['ret_name']);
        $shop_name = mysqli_real_escape_string($con, $_POST['shop_name']);
        $ret_add = mysqli_real_escape_string($con, $_POST['ret_add']);
        $ret_phn = mysqli_real_escape_string($con, $_POST['ret_phn']);
        $ret_type = mysqli_real_escape_string($con, $_POST['ret_type']);
    
        $sno = mysqli_real_escape_string($con, $_GET['sno']);
    
        // Update existing record in the database
        $sql = "UPDATE `retailer` SET `ret_name`='$ret_name', `shop_name`='$shop_name', `ret_add`='$ret_add',  `ret_phn`='$ret_phn', `ret_type`='$ret_type' WHERE `sno`='$sno'";
    
        // Execute the query
        if (mysqli_query($con, $sql)) {
            // Flag for successful update
            $update = true;
            header('location: ret_show.php');
            exit(); // It's a good practice to exit after redirect
        } else {
            echo "ERROR: " . mysqli_error($con);
        }
    }

?> 
</body>
</html>