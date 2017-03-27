<?php 
    include_once ("okviri/user.class.php");
    $user=new User();
    
    session_start();
    if (!isset($_SESSION["prijava"])) {
        header("Location: index.php");
        exit();
    }
    
    unset($_SESSION["prijava"]);  
    session_destroy();

    header("Location: prijava.php");

?>
