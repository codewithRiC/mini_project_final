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
 $query="select sno,ret_name,shop_name,ret_add,ret_phn,ret_type from retailer";
 $result=mysqli_query($con,$query);
 if(isset($_GET['sno']))
 {
    $id = $_GET['sno'];
    $del = mysqli_query($con, "DELETE FROM `retailer` WHERE `sno`='$id'");
    header('location:ret_show.php');

 }
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
    <title>Retailer view</title>
</head>
<body>
   
    <!-- Header seaction -->

    <?php include('include/header.php') ?>

    <!-- <header class="topheader">
        
          <div class="logo">
              <img src="css/logo.png" alt="logo">
          </div>
          <div class="topheader-name">
              <h1>Ultimate Marketing Solution</h1>
          </div>
          <div class="nav-search">
            
            <input placeholder="Search " class="search-input">
            <div class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
      
       
    </header> -->


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
                <h1 > view<span>RETAILER</span></h1>
            </div>
            <div class="back">
              <i class="fa-regular fa-circle-left"></i>  
              <a href="retailer.php" style="text-decoration:none">Back to Retailer</a>
            </div>
            <div class="ret_table">
                   
                   <table>
                       <tr>
                         <th>SL NO.</th>
                         <th>Retailer Name</th>
                         <th>Shop Name</th>
                         <th>Address</th>
                       
                         <th>Phone Number</th> 
                         <th>Type</th>  
                         
                       </tr>
                       <tr>
                       <?php
                        $sno=1;
                          while($row=mysqli_fetch_assoc($result))
                           {
                        ?>
                          <td><?php echo $sno++;?></td>
                          <td><?php echo $row['ret_name'];?></td>
                          <td><?php echo $row['shop_name'];?></td>
                          <td><?php echo $row['ret_add'];?></td>
              
                          <td><?php echo $row['ret_phn'];?></td>
                          <td><?php echo $row['ret_type'];?></td>
                          <td><a href='ret_update.php?sno=<?php echo $row['sno']; ?>' class="btn">UPDATE</a></td> 
                          <td><a href='ret_show.php?sno=<?php echo $row['sno']; ?>' class="btn"> DELETE</a></td>  
                         
                        </tr>
                        <?php
                           }
                        ?>

                        </table>
            </div>
            
        </section>
        
    </div>
</div>   
</body>
</html>