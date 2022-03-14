<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.module.css?v=<?php echo time(); ?>">

    <title>Home</title>
</head>
<body>

    <!-- navbar include from php-->
    <?php include 'navbar.php' ?> 



    <!-- main information home page -->
    <div class="main_item">

<?php
$id= mysqli_connect("127.0.0.1","root","","blog");
$req="SELECT * FROM `blogs` ORDER BY views DESC limit 1 ";
$res=mysqli_query($id, $req);
while($ligne = mysqli_fetch_assoc($res))
{ ?>
        <div class="main_item_text">
            <a href="article.php?id=<?php echo $ligne["id"]?>"><img src="../uploads/<?php echo $ligne["imageName"]?>" class="main_img" alt="main_picture"></a>
            <a href=""><h1><?php echo $ligne["title"]?></h1></a>
        </div>

<?php } ?>
<div class="column_main_item">
<!--SQL data import for header-->
<?php
$id= mysqli_connect("127.0.0.1","root","","blog");
$req="SELECT * FROM `blogs` ORDER BY date DESC limit 2 ";
$res=mysqli_query($id, $req);
while($ligne = mysqli_fetch_assoc($res))
{ ?>
            <p><?php echo $ligne["category"]?></p>
            <a href="article.php?id=<?php echo $ligne["id"]?>"><img src="../uploads/<?php echo $ligne["imageName"]?>" alt="main_picture"></a>
            <a href="article.php?id=<?php echo $ligne["id"]?>"><h3><?php echo $ligne["title"]?></h3></a>
<?php } ?>
<!-- end of SQL data import for header-->
    </div>
</div>

<?php
if(isset($_GET['category'])){?>
<h1 class="news"><?php echo $_GET['category'] ?></h1><?php
}
else if(isset($_GET['search'])){?>
    <h1 class="news">Article for <?php echo $_GET['search'] ?></h1><?php
}
else{?>
<h1 class="news">News</h1><?php
}
?>

<!--SQL connection and number per page limit-->
<?php
$num_per_page=6;

if(!isset($_GET['page'])){
    $page=1;
}
else{
    $page=$_GET['page'];
}


/*if url include category*/
if(isset($_GET['category'])){

    $cat=$_GET['category'];
    $reqs="SELECT * FROM `blogs` WHERE `category` = '$cat' ";
    $result=mysqli_query($id, $reqs);
    $number_of_results = mysqli_num_rows($result);
    $this_page_first_result = ($page-1)*$num_per_page;
    $this_page_first_result;
    $num_per_page;
    $num_of_page = ceil ($number_of_results/$num_per_page);

    $req="SELECT * FROM `blogs` WHERE  `category` = '$cat' ORDER BY DATE DESC limit $this_page_first_result,$num_per_page ";
    $res=mysqli_query($id, $req);
    
}


/*if url include search from searchbar*/
else if(isset($_GET['search'])){

    $search=$_GET['search'];
    $reqs="SELECT * FROM `blogs` WHERE `title` LIKE '%$search%'";
    $result=mysqli_query($id, $reqs);
    $number_of_results = mysqli_num_rows($result);
    $this_page_first_result = ($page-1)*$num_per_page;
    $this_page_first_result;
    $num_per_page;
    $num_of_page = ceil ($number_of_results/$num_per_page);
    
    $req="SELECT * FROM `blogs` WHERE `title` LIKE '%$search%' OR `description` LIKE '%$search%' OR `content` LIKE '%$search%'  ORDER BY DATE DESC limit $this_page_first_result,$num_per_page ";
    $res=mysqli_query($id, $req);
}


else{
$reqs="SELECT * FROM `blogs`";
$result=mysqli_query($id, $reqs);
$number_of_results = mysqli_num_rows($result);
$this_page_first_result = ($page-1)*$num_per_page;
$this_page_first_result;
$num_per_page;
$num_of_page = ceil ($number_of_results/$num_per_page);

$req="SELECT * FROM `blogs` ORDER BY DATE DESC limit $this_page_first_result,$num_per_page ";
$res=mysqli_query($id, $req);
}

/*end of condition*/
while($ligne = mysqli_fetch_assoc($res))
{
?>



    <!--new posts-->
    <div class="items">
        <div class="items_text">
            <p class="item_category"><?php echo $ligne["category"]?></p>
            <a href="article.php?id=<?php echo $ligne["id"]?>"><h3><?php echo $ligne["title"]?></h3></a>
            <a href="article.php?id=<?php echo $ligne["id"]?>"><p class="description"><?php echo $ligne["description"]?></p></a>
            <?php
            if(isset($_SESSION['username']) AND $_SESSION['username']==$ligne['author'] OR isset($_SESSION['username']) AND $_SESSION['username'] == ucfirst($ligne['author'])){?>
            <a href="my_account.php" class="author"><p>By <?php echo $ligne["author"]?></p></a><?php
            }
            else{?>
                <a href="user.php?name=<?php echo $ligne["author"]?>" class="author"><p>By <?php echo $ligne["author"]?></p></a><?php
            }?>
            <p class="date"><?php echo $ligne["date"]?></p>
        </div>
        <a href="article.php?id=<?php echo $ligne["id"]?>"><img src="../uploads/<?php echo $ligne["imageName"]?>" alt="picture"></a>
    </div>




<!-- end of SQL import and page display-->   

<?php
}?>
<div class="pages">
<?php
for($page=1;$page<=$num_of_page;$page++){
echo '<a  class="next" href="home.php?page='.$page.'">'.$page.'</a>';    
}
?>
</div>

<!-- contact include from php-->
<?php include 'contact.php' ?> 


</body>
</html>