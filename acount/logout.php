<?php 
    session_start();
    if(isset($_POST['logOut']) && !empty($_POST['logOut'])) {
        session_destroy();
        $_SESSION = array();

        header("Location: pageLogin.php");
        exit();
    }