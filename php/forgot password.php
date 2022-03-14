<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.module.css?v=<?php echo time(); ?>">
    <title>Password Recovery</title>
</head>
<body>


<div id="sendCode">
    <!--labels-->
<div class="register">
    <h1>Reset Password</h1>
    <form action="" method="post">
    <label for="email">email</label>
    <br>
    <input type="text" name="email" required>
    <br>
    <input type="submit" class="submit_register" value="Send Code" name="sendMail">
</form>
</div>
<?php
    if(isset($_POST['sendMail']))
    {
        $code=rand(1000000,9999999);
        $mail=$_POST["email"];
        include "mail.php";       
$email->setFrom($mail, 'Wissen contact');
$email->addAddress($mail, 'Wissen Contact'); 
$email->addAddress($mail); 
$email->addReplyTo($mail, 'Reset pasword'); 
$email->isHTML(true);

$email->Subject = 'Password reset code';
$email->Body = "Hi there, here is your password recovery code : ".$code.", you can use it to change your password.";
if(!$email->send()) {
   echo 'Error';
   echo 'Mailer Error: ' . $email->ErrorInfo;
}

$id= mysqli_connect("127.0.0.1","root","","blog");
        $req = "SELECT * FROM `users` WHERE `mail` = '$mail' ";   
        $res= mysqli_query($id, $req);
        if(mysqli_num_rows($res)==0){
            echo "<p class='error'>Unknown mail</p>";
            }
        if(mysqli_num_rows($res)==1){
        $req="UPDATE `users` SET `code`=$code WHERE `mail` ='$mail'";
        $res=mysqli_query($id, $req);
        echo "<br><br><p class='error'>Code sent to your E-mail adress</p>";
        header("Refresh:2;url=reset password.php");
        }    
    }
?>
</div>


<!-- contact include from php-->
<?php include 'contact.php' ?> 


</body>
</html>