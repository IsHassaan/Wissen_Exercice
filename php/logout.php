<?php
session_start();
echo "You have been disconnected";
session_destroy();
header('Location:home.php'); 
?>