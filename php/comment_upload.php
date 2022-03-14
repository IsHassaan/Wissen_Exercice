<?php
if($_SESSION['username']==NULL AND $_GET['id']==NULL){
    header('Location: home.php');
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/comment_section.module.css?v=<?php echo time(); ?>">
    <title>Upload_comment</title>
</head>
<body>

<?php 
    $username=$_SESSION['username'];
    $article_id=$_GET['id'];
$id= mysqli_connect("127.0.0.1","root","","blog");
    $req="SELECT `picture` FROM `users` WHERE name='$username' LIMIT 1";
    $res=mysqli_query($id, $req);
    while($ligne = mysqli_fetch_assoc($res))
{
$image=$ligne["picture"];
}
?> 
<div id="upload_comments">

    <form action="" method="post" enctype='multipart/form-data'>
        <textarea name="content" rows="4" cols="25" maxlength="200">Give your opinion</textarea>
        <input type="submit" value="Post" name="send_comment" class="sub">
    </form> 

</div>



<?php
if(isset($_POST['send_comment'])){ 
    
$id= mysqli_connect("127.0.0.1","root","","blog");
$content = mysqli_real_escape_string($id, nl2br($_POST["content"])); 
$req="INSERT INTO `comments`(`article_id`, `content`, `image`, `author`, `date`) VALUES ('$article_id','$content','$image','$username',NOW())";

        if(isset($_SESSION['username'])){
        $res=mysqli_query($id, $req);
            if(!$res)
            {
                echo "Error";
                echo $content;
            }
            else
            {
               ?><script>window.location="article.php?id=<?php echo $article_id ?>"</script>';<?php
            }
    }
    else{
        echo "not connected";
    }     
}
?>


</body>
</html>