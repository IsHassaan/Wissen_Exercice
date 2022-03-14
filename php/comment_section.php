<link rel="stylesheet" href="../css/comment_section.module.css?v=<?php echo time(); ?>">


<!-- SQL sata import -->
<?php
$id= mysqli_connect("127.0.0.1","root","","blog");
$article_id=$_GET['id'];
$req="SELECT * FROM `comments` WHERE article_id ='$article_id' ORDER BY DATE ASC LIMIT 10";
$res=mysqli_query($id, $req);
while($ligne = mysqli_fetch_assoc($res))
{
?>



<div class="comments">

    <div class="comments_user">
        <img src="../uploads/<?php echo $ligne["image"]?>" alt="profile_picture">
        <a href="user.php?name=<?php echo $ligne["author"]?>"><p class="user"><?php echo $ligne["author"]?></p></a>
    </div>

    <div class="comments_txt">
        <p class="comments_content"><?php echo $ligne["content"]?></p>
        <p class="comments_date"><?php echo $ligne["date"]?></p>
    </div>

</div>


<!-- end of SQL data importation -->   

<?php
}?>