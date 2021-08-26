<?php
require_once 'config.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Login</title>

    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>


    <script>function log(){
        $(".forgot, .login").toggle();
    }
    </script>
</head>
<body>


<div class="container">
    <div class="forms-container">
        <div class="signin-signup">

            <form action="login.php" method="post" class="sign-in-form login">
                <h2 class="title" style="font-weight: 700">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="user_login" placeholder="Email" autocomplete="off" name="email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="user_pass" placeholder="Password" autocomplete="off" name="password">
                </div>
                <input type="submit" name="loginbutton"  value="Login" class="btn solid">
                <div class="help-action">
                    <p><a href="#" style="color: #4481eb;margin-top: 10px" onclick="log()">Forgot your password?</a></p>
                </div>
                <?php

                $l = 0;

                if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
                    $l = (int)$_GET["r"];

                    if (array_key_exists($l, $messages)) {
                        echo "
                            <div class='alert m-3' role='alert' style='display:block;padding:15px;border-radius:4px;'>
                            ".$messages[$l]."
                            </div>
                            ";
                    }
                }
                ?>
            </form>

            <form class="sign-in-form forgot" action="web.php" method="post" name="forget" id="forget" style="display:none;">
                <h2 class="title" style="font-weight: 700">Forgot Password</h2>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="user_login" placeholder="Email" autocomplete="off" name="email">
                </div>
                <input type="hidden" name="action" value="forget">
                <button type="submit" name="asd" class="btn solid">Send</button>
                <div class="help-action">
                    <p><a href="#" style="color: #4481eb;margin-top: 10px" onclick="log()">You have an account?</a></p>
                </div>
            </form>

            <form method="post" action="registration.php" class="sign-up-form" enctype="multipart/form-data">
                <h2 class="title" style="font-weight: 700">Create Account</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" id="user_fn" placeholder="First Name"  autocomplete="off" name="firstname">
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" id="user_ln" placeholder="Last Name"  autocomplete="off" name="lastname">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="user_email" placeholder="Email"  autocomplete="off" name="email">
                </div>
                <div class="input-field">
                    <i class="fas fa-phone"></i>
                    <input type="text" id="phone" placeholder="Phone"  autocomplete="off" name="phone">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="user_pass" placeholder="Password"  autocomplete="off" name="password">
                </div>
                <label>
                <input type="checkbox" onchange="$('.dentist').toggle()"  value="1" name="dentist">
                    Sign up as dentist</label>
                <br/>
                <div class="dentist" style="display:none;">
                    <div class="input-field">
                        <i class="fas fa-building"></i>
                        <input type="text"  id="user_fn" autocomplete="off" placeholder="Dentist name" name="dentist_name">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-medkit"></i>
                        <input type="text"  id="user_ln" autocomplete="off" placeholder="Specialization" name="specialization">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-file"></i>
                        <input type="file" autocomplete="off" placeholder="Profile picture" id='photo' name='picture'>
                    </div>
                </div>
                <br/>
                <input type="submit" name="registerbutton" value="Sign Up" class="btn solid">
            </form>
        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here?</h3>
                <button class="btn transparent" id="sign-up-btn" style="margin-top: 10px">Sign up</button>
            </div>
            <img src="pic/p2.png" class="image" alt="">
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>One of us ?</h3>
                <button class="btn transparent" id="sign-in-btn" style="margin-top: 10px">
                    Sign in
                </button>
            </div>
            <img src="pic/p2.png" class="image" alt="">
        </div>
    </div>



</div>


</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script> 
<script src="js/script.js"></script>
</html>
