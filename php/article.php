<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/article.module.css?v=<?php echo time(); ?>">
    <title>Article</title>
</head>
<body>


<!-- navbar include from php-->
<?php include 'navbar.php' ?> 

<!--redirection if no id in url-->   
<?php  if(!isset($_GET['id'])){
        header("Refresh:0;url=home.php");
    }
?>

<!--add view to counter-->
<?php
$ids=$_GET['id'];
$conn= mysqli_connect("127.0.0.1","root","","blog");
$sql = "UPDATE `blogs` SET `views`= views+1 WHERE id=$ids";
$result = $conn->query($sql);
?>

<!--edit button-->
<?php
if(isset($_SESSION['username'])){
$un= $_SESSION['username']; 
include 'edit_post.php';
}
?> 

<!-- SQL sata import -->
<?php
$id= mysqli_connect("127.0.0.1","root","","blog");
$req="SELECT * FROM `blogs` WHERE id='$ids'";
$res=mysqli_query($id, $req);
while($ligne = mysqli_fetch_assoc($res))
{
?>

    <div class="article">
<?php
if(isset($_SESSION['username']) AND $_SESSION['username']==$ligne['author'] OR isset($_SESSION['username']) AND $_SESSION['username'] == ucfirst($ligne['author'])){?>       
<!--edit button-->
<button id="close_ep" onclick="closeEditPost()">X</button>
<button id="edit_post_button" onclick="showEditPost()">Edit</button>
<script src="../js/display.js"></script>
<?php
}
if(isset($_SESSION['username']) AND $_SESSION['username']==$ligne['author'] OR isset($_SESSION['username']) AND $_SESSION['username'] == ucfirst($ligne['author'])){
?><a href="my_account.php"><p class="article_author">By <?php echo $ligne["author"]?></p></a>
<?php   
}
else{?>
<a href="user.php?name=<?php echo $ligne["author"]?>"><p class="article_author">By <?php echo $ligne["author"]?></p></a><?php
}?>

        <h3><?php echo $ligne["title"]?></h3>
        <p class="article_description"><?php echo $ligne["description"]?></p>
        <img src="../uploads/<?php echo $ligne["imageName"]?>" alt="picture">
        <p class="article_content"><?php echo nl2br($ligne["content"])?></p>
        <p class="article_date"><?php echo $ligne["date"]?></p>
    </div>

<!-- end of SQL data importation -->   

<?php
}?>

<h1 class="comments_title">Comments</h1>
<?php include 'comment_section.php' ?> 

<?php 
if(isset($_SESSION['username'])){?>
    <p class="comment_sub">Comment</p>
<?php
/* comment upload include from php*/
include 'comment_upload.php';

}
?>

<!-- contact include from php-->
<?php include 'contact.php' ?> 
</body>
</html>