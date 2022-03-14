
<link rel="stylesheet" href="../css/upload.module.css?v=<?php echo time(); ?>">

<?php
if($_SESSION['username']==NULL){
    header('Location: login.php');
}
$un= $_SESSION['username']; 

$id= mysqli_connect("127.0.0.1","root","","blog");
$req="SELECT * FROM `users` WHERE `name`= '$un'";
$res=mysqli_query($id, $req);
while($ligne = mysqli_fetch_assoc($res))
{
?>

<div id="edit_p">
<div class="upload">
<h1>Edit your profile</h1>
    <form action="" method="post" enctype='multipart/form-data'>
        <label for="file">Picture</label><br><br>
        <img src="../uploads/<?php echo $ligne["picture"]?>" class="editimg" alt="image"><br>
            <input type='file' name='file' class='file'>
            <br><br><br><br>
         <label for="content">Bio</label><br><br>
            <textarea name="content" rows="3" cols="20" class="content" maxlength="75" ><?php echo nl2br($ligne["bio"])?></textarea>
            <br><br><br><br>
        <input type="submit" value="Update" name="sent" class="sub">
    </form>
</div> 
</div>

<?php
}
?>
<?php
if(isset($_POST['sent'])){

$idd= mysqli_connect("127.0.0.1","root","","blog");
    $content = mysqli_real_escape_string($id,($_POST["content"])); 
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

if ($_POST['file'] != $imageName){
$requ="UPDATE `users` SET `picture`='$imageName',`bio`='$content' WHERE `name` = '$un'";
}

else{
$requ="UPDATE `users` SET `bio`='$content' WHERE `name` = '$un'";
}

    if(isset($_SESSION['username'])){

        $result=mysqli_query($idd, $requ);
        if(!$result)
        {
            echo "Error";
        }
        else
        {
            echo '<script>window.location="my_account.php"</script>';
        }


    }
    else{
        echo "not connected";
    }

    
}?>
