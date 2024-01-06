<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/ret.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home Page</title>
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
            <a href="home.php" >HOME</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="retailer.php">RETAILERS</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="transaction.php">CREDIT/DEBIT</a>
            <br><br><br>
            <i class="fa-solid fa-circle-dot"></i>
            <a href="reoprt.php" style="color:blue">REPORTS</a>
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
                <h1 > Report<span>SECTION</span></h1>
            </div>
            <div class="add">
                <h2>Reports Generation</h2>
                <form action="report_pdf.php" method="post" id="retadd">
                    
                    <label for="from">FROM:</label>
                    <input type="date" id="from" name="from" required>

                    
                    <label for="to">TO:</label>
                    <input type="date" id="to" name="to" required>
 
                    <div class="btn">
                    <button type="submit" name="generate_excel">Generate Excel</button>
                    <button type="submit" name="generate_pdf">Generate Pdf</button>
                    
                    </div>
                    
                 </form>
                
             </div>
           
           
      </section>
     
    </div>
</div>   
</body>

</html>