<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';


$email = new PHPMailer(True);


$email->isSMTP();  
$email->Host = 'smtp.gmail.com';
$email->SMTPAuth = true;
$email->Username = 'wissen.blog.contact@gmail.com';
$email->Password = 'UaagTVi3CuLQy2c';
$email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$email->Port = 465;
?>