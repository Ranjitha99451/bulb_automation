<?php
session_start();
include 'config.php';

$errors=array();
 if (isset($_POST['login_user']))
 {
    $username=mysqli_real_escape_string($conn, $_POST['username']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);
    
    if(count($errors)==0){
        $password=$password;
        $query="select * from user where username='$username' and password='$password'";
        $result=mysqli_query($conn, $query);
        if(mysqli_num_rows($result)==1)
        {
            $_SESSION['username']=$username;
            $_SESSION['success']="you are now logged in";
            header('Location: index.php');
            exit();
        }
        else{
            array_push($errors, "wrong username/password");
        }
    }
 }
?>