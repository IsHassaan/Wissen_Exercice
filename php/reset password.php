<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.module.css?v=<?php echo time(); ?>">
    <title>Reset Code</title>
</head>
<body>

    <!-- navbar include from php-->
    <?php include 'navbar.php' ?> 

    <div id="validCode">
    <!--labels-->
    <div class="register">
    <h1>Enter the code you received</h1>
    <form action="" method="post">
    <label for="email">email</label>
    <br>
    <input type="text" name="email" >
    <br>
    <label for="code">Recovery Code</label>
    <br>
    <input type="number" name="code" min="1000000" max="9999999">
    <br>
    <input type="submit" class="submit_register" name="sendCode" value="Verify code">
</form>
</div>
<?php
    if(isset($_POST['sendCode']))
    {
        $code=$_POST["code"];
        $mail=$_POST["email"];
$id= mysqli_connect("127.0.0.1","root","","blog");
        $req = "SELECT * FROM `users` WHERE `code` = '$code' AND `mail` = '$mail' ";   
        $res= mysqli_query($id, $req);
        if(mysqli_num_rows($res)==0){
            echo "<p class='error'>Code or Email not matching</p>";
            }
        if(mysqli_num_rows($res)==1){
        $req="UPDATE `users` SET `code`=NULL WHERE `mail` ='$mail'";
        $res=mysqli_query($id, $req);
        echo "<br><br><p class='error'>Code matching</p>";
        header("Refresh:2;url=password recovery.php");
        $_SESSION['code']=true;
        }    
    }
?>

</div>

<!-- contact include from php-->
<?php include 'contact.php' ?> 


</body>
</html>