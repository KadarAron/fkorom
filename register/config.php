<?php
define("SITE", "https://fkorom.proj.vts.su.ac.rs/register/");
define("HOST", "127.0.0.1:3307");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "fkorom");
define("SECRET", "gfhUi34xVbds23Qgk");

$actions = ['login', 'register', 'forget'];

$messages = [
    0 => 'No direct access!',
    1 => 'Unknown user!',
    2 => 'User with this email already exists, choose another one!',
    3 => 'Check your email to active your account!',
    4 => 'Fill all the fields!',
    5 => 'You are logged out!!',
    6 => 'Your account is activated, you can login now!',
    7 => 'Passwords are not equal!',
    8 => 'Format of e-mail address is not valid!',
    9 => 'Password is too short! It must be minimum 8 characters long!',
    10 => 'Something went wrong with mail server. We will try to send email later!',
    11 => 'Your account is already activated!',
    12 => 'Your account is has been updated!',
    13 => 'Your account is has been updated!',
    14 => 'Check your e-mail inbox!',
    15 => 'Please provide your data correctly.',
    16 => 'There was an error. Try again later.'
];
