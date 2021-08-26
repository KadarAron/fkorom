<?php

require_once "config.php";
include "functions_def.php";
include __DIR__."/../db.php";
session_start();


$password = "";
$firstname = "";
$lastname = "";
$email = "";
$action = "";

$referer = $_SERVER['HTTP_REFERER'];
global $actions;

$connection = DB::connect();

$action = mysqli_real_escape_string($connection, $_POST["action"]);


if ($action != "" AND in_array($action, $actions) AND strpos($referer, SITE) !== false) {


    switch ($action) {
        case "forget":
            $email = mysqli_real_escape_string($connection, trim($_POST["email"]));
            if (existsUser($email)) {
                $code = createCode(40);
                $expFormat = mktime(
                    date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                );

                $expDate = date("Y-m-d H:i:s",$expFormat);
                if (setCodePassword($email,$code,$expDate)) {
                    sendForgotPassword($username, $email, $code);
                    redirection("index.php?r=14");
                } else {
                    redirection("index.php?r=10");
                }

            } else {
                redirection('index.php?r=2');
            }
            break;

        default:
            redirection('index.php?r=0');
            break;
    }

} else {
    redirection("index.php?r=0");
}
