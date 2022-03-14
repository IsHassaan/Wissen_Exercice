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

<!--SQL injection of blog-->
<div id="uploadpost">

<div class="upload">
    <h1>Upload your blog</h1>
        <form action="" method="post" enctype='multipart/form-data'>
            
        <label for="title">Blog title</label>
            <input type="text" name="title" maxlength="100" required>
            <br>
            <label for="description">Description</label>
            <textarea name="description" rows="3" cols="25" class="description" maxlength="170"  required>Blog Description</textarea>
            <br>
            <label for="file">Thumbnail</label>
            <input type='file' name='file' class='file' required>
            <label for="category">Category</label>

        <select id='category' name='category'>
<option value="Economy">Economy</option>
            <option value="Economy">Economy</option>
            <option value="Series/Movies">Series/Movies</option>
            <option value="Crypto-Currency">Crypto-Currency</option>
            <option value="Education">Education</option>
            <option value="Politic">Politic</option>
            <option value="Sports">Sports</option>
            <option value="Nutrition">Nutrition</option>
            <option value="Social Media" selected>Social Media</option>
        </select>

             <label for="content">Blog content</label>
             <textarea name="content" rows="4" cols="25" maxlength="4000" class="content">Write your blog here</textarea>
            <input type="submit" value="Post" name="send_upload" class="sub">
        </form>
   </div> 

 </div>


<?php
if(isset($_POST['send_upload'])){
$id= mysqli_connect("127.0.0.1","root","","blog");

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

$req="INSERT INTO `blogs`(`title`, `content`, `category`, `description`, `author`, `imageName`, `date`, `nbLikes`, `views`) VALUES ('$title','$content','$category','$description','$author','$imageName',NOW(),0,0)";
        if(isset($_SESSION['username'])){

        $res=mysqli_query($id, $req);
        if(!$res)
        {
            echo "Erreur";
        }
        else
        {
            echo '<script>window.location="my_account.php"</script>';
        }
    }
    else{
        echo "not connected";
    }

        
}
?>

</body>
</html>