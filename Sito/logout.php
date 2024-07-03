<?php
session_start();
unset($_SESSION);
header('Location: homepage.php');
session_destroy();
?>