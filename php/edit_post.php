<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/upload.module.css?v=<?php echo time(); ?>">
</head>
<body>
    
<?php
if($_SESSION['username']==NULL){
    header('Location: login.php');
}
$un= $_SESSION['username']; 
?>


<!--SQL selection of blog by id-->
<?php
$id= mysqli_connect("127.0.0.1","root","","blog");
$req="SELECT * FROM `blogs` WHERE id='$ids'";
$res=mysqli_query($id, $req);
while($ligne = mysqli_fetch_assoc($res))
{
if($_SESSION['username']==$ligne['author']){?>

<div id="edit_post">

<div class="upload">
    <h1>Upload your blog</h1>
        <form action="" method="post" enctype='multipart/form-data'>
            
        <label for="title">Blog title</label>
            <input type="text" name="title" maxlength="100"  required value="<?php echo $ligne["title"]?>">
            <br>
            <label for="description">Description</label>
            <textarea name="description" rows="3" cols="25" class="description" maxlength="170"  required><?php echo $ligne["description"]?></textarea>
            <br>
            <label for="file">Thumbnail</label>
            <input type='file' name='file' class='file'>
            <label for="category">Category</label>

        <select id='category' name='category'>
            <option value="Economy">Economy</option>
            <option value="Series/Movies">Series/Movies</option>
            <option value="Crypto-Currency">Crypto-Currency</option>
            <option value="Education">Education</option>
            <option value="Politic">Politic</option>
            <option value="Sports">Sports</option>
            <option value="Nutrition">Nutrition</option>
            <option value="Social Media">Social Media</option>
            <option value="<?php echo $ligne["category"]?>" selected><?php echo $ligne["category"]?></option>
        </select>

             <label for="content">Blog content</label>
             <textarea name="content" rows="4" cols="25" maxlength="4000" class="content"><?php echo $ligne["content"]?></textarea>
            <input type="submit" value="Update" name="send_upload" class="sub">
        </form>
   </div> 

 </div>
<?php
}}?>

<!--posting edited content-->
<?php
if(isset($_POST['send_upload'])){

        $author=$un= $_SESSION['username']; 
        $category=$_POST["category"];
        //nl2br//
        $title = mysqli_real_escape_string($id, $_POST["title"]);
        $description = mysqli_real_escape_string($id,($_POST["description"]));
        $content = mysqli_real_escape_string($id,$_POST["content"]);


        $imageName = $_FILES['file']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if( in_array($imageFileType,$extensions_arr) ){
        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$imageName)){
        $image_base64 = base64_encode(file_get_contents('../uploads/'.$imageName) );
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

    }
}

if($imageName==NULL){
$req="UPDATE `blogs` SET `title`='$title', `content`='$content', `category`='$category', `description`='$description', `author`='$author' WHERE `id` = '$ids'";   
}
else{
$req="UPDATE `blogs` SET `title`='$title', `content`='$content', `category`='$category', `description`='$description', `author`='$author', `imageName`='$imageName' WHERE `id` = '$ids'";
}
        if(isset($_SESSION['username'])){

        $res=mysqli_query($id, $req);
        if(!$res)
        {
            echo "Error";
        }
        else
        {
            echo '<script>window.location="article.php?id='.$ids.'"</script>';
        }
    }  
}
?>

</body>
</html>