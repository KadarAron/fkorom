<?php
require_once "db_config.php";
require_once "config.php";

function redirection($url)
{
    header("Location:$url");
    exit();
}

function checkUserLogin($username, $enteredPassword)
{
    global $connection;

    $sql = "SELECT id_user, password FROM users_web 
            WHERE username = '$username'
            AND active=1 LIMIT 0,1";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    $data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result)) {
            $data['id_user'] = (int)$record['id_user'];
            $registeredPassword = $record['password'];
        }

        if (!password_verify($enteredPassword, $registeredPassword)) {
            $data = [];
        }
    }
    return $data;

}

function existsUser($email)
{

	$connection = DB::connect();

    $sql = "SELECT id_user FROM users
            WHERE email = '$email' AND (registration_expires>now() OR active ='1')";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    if (mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}
function registerUser($username, $password, $firstname, $lastname, $email, $code)
{

    global $connection;

    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users_web (username,password,firstname,lastname,email,code,registration_expires,active)
             VALUES ('$username','$passwordHashed','$firstname','$lastname','$email','$code',DATE_ADD(now(),INTERVAL 1 DAY),0)";


    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    return mysqli_insert_id($connection);

}

function createCode($length)
{
    $down = 97;
    $up = 122;
    $i = 0;
    $code = "";

    $div = mt_rand(3, 9);

    while ($i < $length) {
        if ($i % $div == 0)
            $character = strtoupper(chr(mt_rand($down, $up)));
        else
            $character = chr(mt_rand($down, $up)); 
        $code .= $character;
        $i++;
    }
    return $code;
}

function sendData($username, $email, $code)
{

    $header = "From: WEBMASTER <webmaster@vts.su.ac.rs>\n";
    $header .= "X-Sender: webmaster@vts.su.ac.rs\n";
    $header .= "X-Mailer: PHP/" . phpversion();
    $header .= "X-Priority: 1\n";
    $header .= "Reply-To:support@vts.su.ac.rs\r\n";
    $header .= "Content-Type: text/html; charset=UTF-8\n";
    $message = "";
    $message .= "To activate your account click on the link: " . SITE . "active.php?code=$code";
    $to = $email;
    $subject = "Registration at Dentist";
    return mail($to, $subject, $message, $header);
}

function sendForgotPassword($username, $email, $code)
{
    $header = "From: WEBMASTER <webmaster@vts.su.ac.rs>\n";
    $header .= "X-Sender: webmaster@vts.su.ac.rs\n";
    $header .= "X-Mailer: PHP/" . phpversion();
    $header .= "X-Priority: 1\n";
    $header .= "Reply-To:support@vts.su.ac.rs\r\n";
    $header .= "Content-Type: text/html; charset=UTF-8\n";
    $message = "";
    $message .= "To reset your account click on the link: " . SITE . "/forgotpassword?token=$code";
    $to = $email;
    $subject = "Forgot password at Dentist.";
    return mail($to, $subject, $message, $header);
}

function setCodePassword($email, $code, $expDate){
    global $connection;

    $sql = "UPDATE `users` SET `code` = '$code' , `new_password_expires` = '$expDate' WHERE `users`.`email` = '$email'";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    return true;
}
