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
 if(isset($_GET['shop_name']))
 {
    $id = $_GET['shop_name'];
    $del = mysqli_query($con, "DELETE FROM `retailer` WHERE `shop_name`='$id'");

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/ret.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Transaction Page</title>
</head>
<style>
#transaction {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#transaction td, #transaction th {
  border: 1px solid #ddd;
  padding: 8px;
}

#transaction tr:nth-child(even){background-color: #f2f2f2;}

#transaction tr:hover {background-color: #ddd;}

#transaction th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
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
            <a href="home.php" >HOME</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="retailer.php">RETAILERS</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="transaction.php" style="color:blue">CREDIT/DEBIT</a>
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
     if(isset($_GET['ret_id'])){
        $sno = $_GET['ret_id'];
    $query1 = "select * from `transaction` where trans_type='Credit' and sno='$sno'";
    $result1 = mysqli_query($con,$query1);
    
    $credit = 0;
    // Loop through the result set and calculate the total
    while ($row = mysqli_fetch_assoc($result1)) {
       $credit += $row['amount'];
    }
    
    $query2 = "select * from `transaction` where trans_type='Debit' and sno='$sno'";
    $result2 = mysqli_query($con,$query2);
    
    $debit = 0;
    // Loop through the result set and calculate the total
    while ($row = mysqli_fetch_assoc($result2)) {
      $debit += $row['amount'];
    }
    
    $balance = $credit - $debit;
}
    ?>
<?php 
    if(isset($_GET['ret_id'])){
        $sno = $_GET['ret_id'];
        $query  = "select * from retailer where sno='$sno'";
       $result =  mysqli_query($con,$query);

       $data = mysqli_fetch_assoc($result);

 

?>

    <div class="rect2">
        <section class="dash" id="dash">
            <div class="header">
                <h1 >Shop: <span><?php echo $data['shop_name']; ?></span></h1>
                <span style="padding:7px 10px;border-radius:5px;font-weight=800">Balance : ₹<?php echo $balance; ?></span>
               <div class="btn"  >
                 <a href="transaction.php" ><button type="button" name="button" >Back</button></a>
                 <a href="add_credit_debit.php?ret_id=<?php echo $data['sno']?>" ><button type="button" name="button" >Add</button></a>
                 <a href="export.php?ret_id=<?php echo $data['sno']?>"><button type="button" name="button" >Export to excel </button></a>
                 <a href="export_pdf.php?ret_id=<?php echo $data['sno']?>"><button type="button" name="button">Export to pdf</button></a>
                </div>  
            </div>

      <?php } ?>     
            <table id="transaction">
  <tr>
    <th> S no</th>
    <th>Date</th>
    <th>Shop</th>
    <th>Amount</th>
    <th>Bill No</th>
    <th>Action</th>
  </tr>
  <?php 
    
    if(isset($_GET['ret_id'])){
        $sno = $_GET['ret_id'];
        $query  = "select * from transaction where sno='$sno'";
       $result =  mysqli_query($con,$query);

     
      $srno = 1;
       while($row = mysqli_fetch_assoc($result)){
  ?>
  <tr>
    <td><?php echo $srno++ ;?></td>
    <td><?php echo $row['date'] ;?></td>
    <td><?php echo $data['shop_name']; ?></td>
    <?php if($row['trans_type']=='Credit') {?>
    <td style="background-color:green;color:white"> + ₹<?php echo $row['amount'] ;?></td>
    <?php } else {?>
        <td style="background-color:red;color:white"> - ₹<?php echo $row['amount'] ;?></td>
        <?php } ?>
    <td><?php echo $row['bill_no'] ;?></td>
    <td>
        <a href="edit_credit_debit.php?trans_id=<?php echo $row['trans_id']?>">Edit</a>
        <a href="trans_edit.php?trans_id=<?php echo $row['trans_id']?>"  >Delete</a>
</td>
  </tr>
  
<?php } } ?>
  
</table>

<?php 
 if(isset($_GET['trans_id'])){
     $trans_id = $_GET['trans_id'];
    
     $query = "DELETE FROM `transaction` WHERE trans_id='$trans_id'";
    //  if($con->query($query) === true){
        
       
    //     header('location:transaction.php');
    // }else{
    //     echo "ERROR: $sql <br> $conn->error";
    // }
    $result = mysqli_query($con,$query);
    if($result===true){
        header('location:trans_edit.php');
    }
   
 }
       
?>
      </section>
    </div>
</div>   
</body>
</html>