<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.module.css?v=<?php echo time(); ?>">
    <title>Signup</title>
</head>
<body>

    <!-- navbar include from php-->
    <?php include 'navbar.php' ?> 


    <!--labels-->
<div class="register">
    <h1>Register</h1>
<form action="" method="post">
    <label for="Username">Username</label>
    <br>
    <input type="text" name="username">
    <br>
    <label for="email">email</label>
    <br>
    <input type="text" name="email" id="">
    <br>
    <label for="password1">password</label>
    <br>
    <input type="password" name="password1" minlength="8">
    <br>
     <label for="password2">password (verification)</label>
     <br>
    <input type="password" name="password2" minlength="8">
    <br>
    <input type="submit" class="submit_register" value="register" name="register">
    <a href="login.php">Already registred ? Click here !</a>
</form>
</div>
<!--SQL injection-->
<?php
if(isset($_POST['register'])){
$name=$_POST["username"];
        $mail=$_POST["email"];
        $password=$_POST["password1"];
        $passwordsz=$_POST["password2"];
        
		$options = array("cost"=>4);
        $hashed_password=password_hash($password,PASSWORD_BCRYPT,$options);

$id= mysqli_connect("127.0.0.1","root","","blog");
        $req = "SELECT * FROM `users` WHERE `name` = '$name' ";
        $reqq = "SELECT * FROM `users` WHERE `mail` = '$mail' ";
        $res= mysqli_query($id, $req);
        $result=mysqli_query($id,$reqq);
        

        if(mysqli_num_rows($res)>0){
        echo "<p class='error'>name already used</p>";
        }
        if(mysqli_num_rows($result)>0){
            echo "<p class='error'>mail already used</p>";
        }
        if(mysqli_num_rows($res)==0 AND mysqli_num_rows($result)==0 AND $password==$passwordsz AND filter_var($mail,FILTER_VALIDATE_EMAIL)){
            $req="INSERT INTO `users`(`name`, `password`, `mail`, `picture`, `bio`, `date`) VALUES ('$name','$hashed_password','$mail','DPP.png','Edit your bio here !',NOW())";
            $res=mysqli_query($id, $req);
            echo "<p class='error'>Successfully registered</p>";
            header("Refresh:1;url=login.php");
        }


        else if ($password!=$passwordsz) {
            echo "<p class='error'>Password not matching</p>";
        }
        else{
            echo "<p class='error'>Invalid Email</p>";
        }
    }
?>

<!-- contact include from php-->
<?php include 'contact.php' ?> 


</body>
</html>