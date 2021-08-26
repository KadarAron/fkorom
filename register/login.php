<?php


session_start();

require_once "db_config.php";
require_once "functions_def.php";



if(isset($_POST['loginbutton'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email_and_pass = "SELECT * from users where email = :email_ AND active = :active";
    $login_query = $conn -> prepare($email_and_pass);
    $login_query->bindValue(':email_',$email);
    $login_query->bindValue(':active',1);
    $login_query->execute();
    
    if($login_query -> rowCount() == 1){
        if($row = $login_query->fetch()){
            $jelszo = $row['password'];
            if(password_verify($password, $jelszo)){
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id_user'];
                $_SESSION['user_type'] = $row['user_type'];
                var_dump($_SESSION);
                header('Location: ../index.php');
            }
            else{
                redirection('index.php?r=15');
            }
        }
    }
    else{
        redirection('index.php?r=1');
    }
}
?>