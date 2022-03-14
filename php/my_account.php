<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.module.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/home.module.css?v=<?php echo time(); ?>">
    <title>My Profile</title>
</head>
<body>


<?php include 'navbar.php' ?>  
<?php
if($_SESSION['username']==NULL){
    header('Location: login.php');
}
$un= $_SESSION['username']; 
?>

<div class="user">
<?php 
$id= mysqli_connect("127.0.0.1","root","","blog");
$req="SELECT * FROM `users` WHERE `name`= '$un'";
$res=mysqli_query($id, $req);
while($ligne = mysqli_fetch_assoc($res))
{
?>

<!--user informations-->
<div class="user_data">
<!--user data row-->
<img class="picture" src="../uploads/<?php echo $ligne["picture"]?>" alt="user_picture">
<div class="user_data_text">
    <!--user data column-->
    <h3 class="user"><?php echo $ligne['name'];?></h3>
    <p class="bio"><?php echo nl2br($ligne["bio"])?></p>
    <p class="date">Created <?php echo $ligne["date"]?></p>

</div>
<button onclick="showEdit()" class="edit">Edit</button>
<button  onclick="showPost()" class="postupload">Post</button>
<script src="../js/display.js"></script>
</div>


<?php 
}
?>

<!--SQL connection and number per page limit-->
<?php
$num_per_page=4;

if(!isset($_GET['page'])){
    $page=1;
}
else{
    $page=$_GET['page'];
}



/*user post informations*/
$id= mysqli_connect("127.0.0.1","root","","blog");
$reqs="SELECT * FROM `blogs` WHERE `author`= '$un'";
$result=mysqli_query($id, $reqs);
$number_of_results = mysqli_num_rows($result);
$this_page_first_result = ($page-1)*$num_per_page;
$this_page_first_result;
$num_per_page;
$num_of_page = ceil ($number_of_results/$num_per_page);
?>


<h1 class="news">Posts</h1>
<?php
$id= mysqli_connect("127.0.0.1","root","","blog);
$req="SELECT * FROM `blogs` WHERE `author`= '$un' ORDER BY DATE DESC";
$res=mysqli_query($id, $req);
while($ligne = mysqli_fetch_assoc($res))
{
?>
    <!--new posts-->
    <div class="items">
        <div class="items_text">
            <p class="item_category"><?php echo $ligne["category"]?></p>
            <a href="article.php?id=<?php echo $ligne["id"]?>"><h3><?php echo $ligne["title"]?></h3></a>
            <a href="article.php?id=<?php echo $ligne["id"]?>"><p class="description"><?php echo $ligne["description"]?></p></a>
            <a href="" class="author"><p>By <?php echo $ligne["author"]?></p></a>
            <p class="date"><?php echo $ligne["date"]?></p>
        </div>
        <a href="article.php?id=<?php echo $ligne["id"]?>"><img src="../uploads/<?php echo $ligne["imageName"]?>" alt="picture"></a>
    </div>




<!-- end of SQL import and page display-->   

<?php
}
?>
<div class="pages">
<?php
for($page=1;$page<=$num_of_page;$page++){
echo '<a  class="next" href="my_account.php?page='.$page.'">'.$page.'</a>';    
}
?>
</div>
<?php include 'upload.php' ?> 
<?php include 'edit.php' ?> 
<button onclick="closePost()" id="close_p">x</button>
<button onclick="closeUpload()" id="close_u">x</button>

<!-- contact include from php-->
<?php include 'contact.php' ?> 



</body>
</html>