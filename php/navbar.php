<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.module.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" type="x-icon" href="../assets/page_logo.png">
    
    <!--fonts for small fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">

</head>
<body>
<?php session_start();?>
<div class="navhead">
    <div class="navbar">

        <button onclick="showSidebar()" id="sidebar">More</button>
        <!-- script for sidebar -->
        <script src="../js/display.js"></script>

        <a href="" class="home_link"></a>

        <div class="navbar_links">
            <a href="home.php?category=Economy">Economy</a>
            <a href="home.php?category=Politic">Politic</a>
            <a href="home.php?category=Sports">Sports</a>
        </div>

        <img src="../assets/account-asset.png" class="account_img" alt="account_logo">

        <div class="navbar_register">
        <?php if(isset($_SESSION['username'])){?>
        <a href="my_account.php">Account</a><?php
        }
        else{?>
        <a href="login.php">Register</a><?php
        }?>
        </div>
        <?php if(isset($_SESSION['username'])){?>
        <a href="logout.php"><img src="../assets/disconnect.png" class="disco_img" alt="logo"></a><?php
        }?>

    </div>

<!-- sidebar include from php-->
<?php include 'sidebar.php' ?>

<!-- searchbar-->
<div class="search">
<form action="home.php" method="get">
   <input type="text" name="search" class="searchbar">
   <input type="submit" value='search' class='sub_search'>
</form>
</div>

    <!--Logo-->
    <a href="home.php"><img src="../assets/logo2.png" class="logo" alt="logo"></a>
</div>

</body>
</html>