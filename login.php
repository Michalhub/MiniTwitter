<?php

    session_start();

    require_once ('config.php');
    require_once ('src/User.php');
    
    $login = $_POST['login'];
    $pass = $_POST['password'];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($login) && trim($login) != '' && isset($pass) && trim($pass) != '') {
            User::userLogin($conn, $login, $pass);
        } else {
            $_SESSION['msg'] = 'Podaj wszystkie dane';
            //Redirect after wrong login info
            header("Location:index.php"); 
        }
    }