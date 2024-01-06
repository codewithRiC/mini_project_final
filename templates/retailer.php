<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Retailer Page</title>
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
                <h1 > Retailer<span>SECTION</span></h1>
            </div>
            <div class="box-container">
                <div class="box">
                    <i class="fa-solid fa-plus"></i>
                    <h3>New Retailer</h3>
                    
                    <a href="ret_add.php" class="btn">ADD RETAILER</a>
                </div>

                <!-- <div class="box">
                  <i class="fa-regular fa-eye"></i>
                    <h3>View </h3>
                   
                    <a href="ret_view.php" class="btn">VIEW RETAILER</a>
                </div> -->

                <div class="box">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <h3>Remove/Edit</h3>

                    <!-- here i am not using ret_edit,ret_view they are just extra
                    -->
                    <a href="ret_show.php" class="btn">REMOVE/EDIT RETAILER</a>
                </div>
            </div>
      </section>
    </div>
</div>   
</body>
</html>