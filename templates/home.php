<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Home Page</title>
</head>

<body>
   
    <!-- Header seaction -->

   <?php include('include/header.php') ?>

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

$query1 = "select * from `transaction` where trans_type='Credit'";
$result1 = mysqli_query($con,$query1);

$credit = 0;
// Loop through the result set and calculate the total
while ($row = mysqli_fetch_assoc($result1)) {
   $credit += $row['amount'];
}

$query2 = "select * from `transaction` where trans_type='Debit'";
$result2 = mysqli_query($con,$query2);

$debit = 0;
// Loop through the result set and calculate the total
while ($row = mysqli_fetch_assoc($result2)) {
  $debit += $row['amount'];
}

$balance = $credit - $debit;
?>
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
            <a href="home.php" style="color:blue">HOME</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="retailer.php">RETAILERS</a>
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
                <h1 > Dash<span>BOARD</span></h1>
            </div>
            <div class="box-container">
                <div class="box">
                    
                    <h3>Credit</h3>
                    <p><?php echo $credit; ?></p>
                   
                </div>

                <div class="box">
                    
                    <h3>Debit</h3>
                    <p> <?php echo $debit; ?> </p>
                   
                </div>

                <div class="box">
                   
                    <h3>Balance</h3>
                    <p> <?php echo $balance; ?> </p>
                    
                </div>
            </div>
            <div class="graph">
              <div class="graph1">
              <table id="transaction">
  <tr>
   
    <th>Shop</th>
    <th>Amount</th>
  
   
  </tr>
  <?php 
    
  
    // $query1  = "SELECT retailer.shop_name,transaction.amount
    // FROM `retailer`
    // INNER JOIN `transaction` ON transaction.sno=retailer.sno ";
    //  $result1 =  mysqli_query($con,$query1);

    $query = "SELECT * FROM `retailer`";
    $result =  mysqli_query($con,$query);
   

     

       while($row = mysqli_fetch_assoc($result)){
  ?>
  <tr>
    <td><?php echo $row['shop_name'] ;?></td>
    
   <?php 
 $sno = $row['sno'];
    $query1 = "SELECT * FROM `transaction` WHERE  trans_type='Credit' and sno='$sno'";
    $result1 =  mysqli_query($con,$query1);
   
    $Credit = 0;
// Loop through the result set and calculate the total
while ($row = mysqli_fetch_assoc($result1)) {
   $Credit += $row['amount'];
}

$query2 = "SELECT * FROM `transaction` WHERE trans_type='Debit' and sno='$sno'";
$result2 =  mysqli_query($con,$query2);

$Debit = 0;
// Loop through the result set and calculate the total
while ($row = mysqli_fetch_assoc($result1)) {
$Debit += $row['amount'];
}

$Balance = $Credit - $Debit;



   
   ?>
    <td style="background-color:green;color:white"> + ₹<?php echo $Balance ;?></td>
    
      
   
    
  </tr>
  
<?php }  ?>
  
</table>
              </div>
              <div class="graph2"> <canvas id="pi" style="width:100%;max-width:600px;height:300px"></canvas></div>

            </div>
      </section>
    </div>
</div>   
</body>

<script>
    var credit = <?php echo json_encode($credit); ?>;
    var debit = <?php echo json_encode($debit); ?>;
    var balance = <?php echo json_encode($balance); ?>;



const xValue = ["Debit", "Credit", "Balance"];
const yValue = [debit, credit, balance];
const barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  
];

new Chart("pi", {
  type: "pie",
  data: {
    labels: xValue,
    datasets: [{
      backgroundColor: barColors,
      data: yValue
    }]
  },
  options: {
    title: {
      display: true,
      text: "Daily Analysis"
    }
  }
});
</script>
</html>