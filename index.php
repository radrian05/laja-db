 <?php 
    if(isset($_SESSION['userId'])){
        header("location: ../views/dashboard.php");
    }else{
        header("location: ../views/login.php");
    } 
?> 