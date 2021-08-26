<?php
session_start();
// include_once '../register/functions_def.php';
require_once '../mvc/view.php';

$quest = false;
$loggedIn = false;

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 2 )
{
    $quest = true;
    $loggedIn = true;
}else{
    redirection('../indexjobs.php');
}



$view = new View();
$currentUser = $view->getCurrentUser();
$currentUser = $currentUser[0];

$threatment = $view->getThreatment();
$appointment = $view->getAppointments();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile</title>

    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/flexslider.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/font-icon.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="banner" role="banner">
         <header id="header" style="position: relative;">
            <div class="header-content clearfix">
               <a class="logo" href="../index.php"><i class="icon icon-anchor"></i> Dentist</a>
               <nav class="navigation" role="navigation">
                  <ul class="primary-nav">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../dentists/index.php">Doctors</a></li>
                    <?php
                        echo $quest ? "<li class='nav-item'>
                        <a class='nav-link' href='../profile/'>Profile</a></li>" : "";
                    ?>
                    <?php
                        echo $loggedIn ? "<li class=\"nav-item\"><a class=\"nav-link\" href='../register/logout.php'> <button type='button' class='btn btn-outline-light' >Log out</button></a></li>" 
                        : "
                        <a href='../register/index.php'> <button type='button' class='btn btn-outline-light my-2 my-sm-0' >Sign Up</button></a>
                        ";
                    ?>
                  </ul>
               </nav>
               <a href="#" class="nav-toggle">Menu<span></span></a> 
            </div>
         </header>
      </section>
<section>
   <div>
       <div class="rightbox">
            <div class="data">
                <form>
                    <h3 style='text-align:center;margin:15px 0;'>Personal Info</h3>
                    <div style='display:flex; justify-content:center; flex-direction:column;'>
                        <label for='password'>Firstname</label>
                        <div>
                            <input type="text" class='form-control'name='first_name' value='<?php echo "$currentUser[firstname]";?>'>
                        </div>
                    </div>
                    
                    <div style='display:flex; justify-content:center; flex-direction:column;'>

                        <label for='password'>Lastname</label>
                        <div>
                            <input type="text" class='form-control' name='last_name' value='<?php echo "$currentUser[lastname]";?>'>
                        </div>
                    </div>

                    <div style='display:flex;justify-content:center; flex-direction:column;'>
                        <label for='password'>Phone</label>
                        <div>
                            <input type="text" class='form-control' name='phone' value='<?php echo "$currentUser[phone]";?>'>
                        </div>
                        <button type="button" class="btn" onclick="Update(this, 'users')" style='margin:10px 0;'>Update</button>
                        <div class='message alert dismissalbe''></div>
                    </div>
                </form>
            </div>
            <div class="data">
                <form>
                    <h3 style='text-align:center;margin:15px 0;'>Password</h3>
                    <div style='display:flex; gap:25px; justify-content:center; flex-direction:column;'>
                        <div>
                            <label for='password'>New Password</label>
                            <div>
                                <input class='form-control' type='password' name='password'>
                            </div>
                        </div>
                        <button type="button" onclick="Update(this, 'users')" class="btn" style='margin:10px 0;'>Update</button>
                        <div class='message alert'></div>
                    </div>
                </form>
            </div>
       </div>
   </div>
   <?php
    echo "<div class='rightbox'>";
    echo "<div class='data'><h3 style='text-align:center;margin:15px 0; '>Threatments</h3>";
    if(sizeof($threatment)){
        for ($i=0; $i < sizeof($threatment); $i++) {
            $value = $threatment[$i];
            echo "
            <div class='profile'>
                  <h4 style='text-align:center;margin:15px 0; '>$value[threatment]</h4>
                  <div style='display:flex; gap:25px; justify-content:center;'>
                      <div>
                          <label for='price'>Price</label>
                          <div style='display:flex; align-items:center; gap:15px;'>
                              <input class='form-control' type='text' name='price' disabled value='$value[price]'>
                              <span>€</span>
                          </div>
                      </div>
                  </div>
              </div>";
        }
    }else{
        echo "<div style='text-align:center;'>You dont have any threatments so far.</div>";
    }
    echo "</div><div class='data'><h3 style='text-align:center;margin:15px 0; '>Appointments</h3>";
    for ($i=0; $i < sizeof($appointment); $i++) {
        $value = $appointment[$i];
        echo "
        <div class='profile'>
              <div style='display:flex; gap:25px; justify-content:center;'>
                <form>
                  <div>
                      <div>
                            <label for='date'>Code</label>
                            <input class='form-control' type='text' disabled name='code' value='$value[code]'>
                            <input class='form-control' type='text' style='display:none;' name='code' value='$value[id]'>
                     </div>
                      <div>
                            <label for='date'>Date</label>
                            <input class='form-control' type='date' name='date' value='$value[date]'>
                      </div>
                      <div>
                            <label for='time'>Time</label>
                            <input class='form-control' type='time' name='time' value='$value[time]'>
                      </div>
                        ";

                        if($value['active'] != 0){
                            echo "
                            <button type='button' onclick=\"Update(this, 'appointment')\" class='btn'>Update</button>
                            <button type='button' onclick=\"Cancel(this, 'appointment', '$value[date]T$value[time]')\" class='btn'>Cancel</button>
                            ";
                        }
                        echo "
                      <button type='button' onclick=\"DeleteEntry(this, 'appointment')\" class='btn'>Delete</button>
                      <div class='message alert'></div>
                  </div>
                </form>
              </div>
          </div>";
    }
    echo "</div></div>"
   ?>
   
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.flexslider-min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/modernizr.js"></script>
<script src="js/main.js"></script>
<script src="../main.js"></script>
<script type="text/javascript" src="js/jquery.contact.js"></script>
<script type="text/javascript" src="js/jquery.devrama.slider.min-0.9.4.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../main.js"></script>


</body>
</html>