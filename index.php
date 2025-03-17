<?php
session_start();

if (isset($_SESSION['userId'])) {
    header("Location: views/home.php");
} else {
    header("Location: views/login.php");
}
exit();
?>