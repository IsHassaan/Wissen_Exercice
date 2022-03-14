<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.module.css?v=<?php echo time(); ?>">
    <title>Login</title>
</head>
<body>

    <!-- navbar include from php-->
    <?php include 'navbar.php' ?> 


    <!--labels-->
<div class="register">
    <h1>Login</h1>
    <form action="" method="post">
    <label for="Username">Username</label>
    <br>
    <input type="text" name="username">
    <br>
    <label for="password1">password</label>
    <br>
    <input type="password" name="password">
    <br>
    <input type="submit" class="submit_register" value="Log In" name="login">
    <a href="forgot password.php">Forgot your password ?</a>
    <a href="signup.php">Not registered ? Click here !</a>
</form>
</div>
<?php
    if(isset($_POST['login']))
    {
        $name=$_POST["username"];
        $password=$_POST["password"];
        $hashed_password=password_hash($password,PASSWORD_BCRYPT);

$id= mysqli_connect("127.0.0.1","root","","blog");
        $req= "SELECT `password` FROM `users` WHERE name='$name'";
        $res= mysqli_query($id, $req);
        while($ligne = mysqli_fetch_assoc($res)){
     
        $hash=$ligne["password"];
        if (password_verify($password, $hash)) {
            echo "<p class='error'>Successfully logged in</p>";
            $_SESSION['username']=$name;
            header("Refresh:1;url=my_account.php");
            //$_SESSION["pseudo"] = $name;
            //header("user:home.php");
        }
        else{
            echo "<p class='error'>Wrong username or password</p>";
        }
            
        }

        }
?>

<!-- contact include from php-->
<?php include 'contact.php' ?> 

</body>
</html>