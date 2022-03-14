<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.module.css?v=<?php echo time(); ?>">
    <title>New Password</title>
</head>
<body>

    <!-- navbar include from php-->
    <?php include 'navbar.php' ?> 
<?php
if($_SESSION['code']!=true){
    header('Location: forgot password.php');
    unset($_SESSION['code']);
}
?>

    <div id="newPassword"> 
    <!--labels-->
    <div class="register">
     <h1>Enter your new password</h1>
     <form action="" method="post">
     <label for="email">email</label>
     <br>
     <input type="text" name="email" >
     <label for="password1">password</label>
     <br>
     <input type="password" name="password1" minlength="8">
     <br>
      <label for="password2">password (verification)</label>
      <br>
     <input type="password" name="password2" minlength="8">
     <br>
     <input type="submit" class="submit_register" value="Change password" name="sendPassword">
 </form>
 </div>
 <?php
     if(isset($_POST['sendPassword']))
     {
         $mail=$_POST["email"];
         $password=$_POST["password1"];
         $passwordsz=$_POST["password2"];
         $options = array("cost"=>4);
         $hashed_password=password_hash($password,PASSWORD_BCRYPT,$options);
 
$id= mysqli_connect("127.0.0.1","root","","blog");
         $reqq = "SELECT * FROM `users` WHERE `mail` = '$mail' ";
         $result=mysqli_query($id,$reqq);
         
         if(mysqli_num_rows($result)==0){
             echo "<br><p class='error'>Mail not found</p>";
         }
         else if ($password!=$passwordsz) {
             echo "<br><p class='error'>Password not matching</p>";
         }
 
 
         else{
$id= mysqli_connect("127.0.0.1","root","","blog");
             $req="UPDATE `users` SET `password`='$hashed_password' WHERE `mail` ='$mail'";
             $res=mysqli_query($id, $req);
             echo "<br><br><p class='error'>Password successfully changed</p>";
             header("Refresh:2;url=login.php");
             unset($_SESSION['code']);
         }  
     }
 ?>
 
</div>

</body>
</html>