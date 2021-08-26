<?php
require_once '../../db.php';
require_once "../functions_def.php";
session_start();

if (
    isset($_POST["password"]) &&
    $_POST["token"]
) {
    $token = $_POST["token"];
    $conn = DB::connect();
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $query = mysqli_query(
        $conn,
        "SELECT * FROM `users` WHERE `code` = '$token'"
    );
    $row = mysqli_num_rows($query);
    if ($row) {
        mysqli_query(
            $conn,
			"UPDATE `users` SET `password` = '$password' , `code` = NULL , `new_password_expires` =  NULL WHERE `code` = '$token'"
        );
        redirection("../index.php?r=12");
    } else {
        redirection("../index.php?r=13");
    }
}
?>
