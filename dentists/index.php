<?php
session_start();
// require_once './register/config.php';
// require_once './register/db_config.php';
// require_once './register/functions_def.php';
require_once '../mvc/view.php';

$admin = false;
$quest = false;
$dentist = false;

$loggedIn = false;

if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 1){
    $admin = true;
}

if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 3){
    $dentist = true;
}

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 2 )
{
    $quest = true;
}
if(isset($_SESSION['user_type'])){
  $loggedIn = true;
}


$view = new View();
$dentists = $view->getDentists();
$services = $view->renderFilter();
$users = $view->users();

$imgURL = "https://fkorom.proj.vts.su.ac.rs/uploads";
?>
<!doctype html>
<html class="no-js" lang="">
   <head>
      <meta charset="utf-8">
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dentist Website / Joo Martin && Kadar Aron</title>

      
    <link rel="stylesheet" href="../profile/style.css"> 
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
      <!-- header section -->
      <section class="banner" role="banner">
         <header id="header" style="position: relative;">
            <div class="header-content clearfix">
               <a class="logo" href="../index.php"><i class="icon icon-anchor"></i> Dentist</a>
               <nav class="navigation" role="navigation">
                  <ul class="primary-nav">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="./index.php">Doctors</a></li>
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
      <div id='tabs'>
        <ul class="nav nav-pills nav-justified">
                    
            <?php
                echo $admin || $dentist ? "
                
                <li class=\"nav-item\">
                    <a onclick=\"toggleTabs(this)\" href='#tabs-1' class=\"active first btn btn-outline-light\">Doctors</a>
                </li>" : "";

                echo $dentist ? "
                <li class=\"nav-item\">
                    <a onclick=\"toggleTabs(this)\" class=\" btn btn-outline-light second\" href='#tabs-3'>Administration</a>
                </li>" : "";

                echo $admin ? "
                <li class=\"nav-item\">
                    <a onclick=\"toggleTabs(this)\" class=\" btn btn-outline-light third\" href='#tabs-2'>Services</a>
                </li>

                <li class=\"nav-item\">
                    <a onclick=\"toggleTabs(this)\" class=\" btn btn-outline-light fourth\" href='#tabs-3'>Users</a>
                </li>

                <li class=\"nav-item\">
                    <a onclick=\"toggleTabs(this)\" class=\" btn btn-outline-light fifth\" href='#tabs-4'>Appointments</a>
                </li>
                
                " : "";
            ?>
        </ul>
        <div class="section teams" id="tabs-1">
            <div class="container">
                <?php
                    if($dentist){
                        echo "
                        <div class='section-header'>
                            <h4 class='wow fadeInDown animated'>My working hours</h4>
                            <form>
                                <div class='row' style='display:flex;justify-content:center;'>
                                    <div class='col-md-2 col-sm-3'>                    
                                        <input class='form-control ' type='time' name='working_start' value='00:00:00'>
                                    </div>
                                    <div class='col-md-2 col-sm-3'>
                                        <input class='form-control' type='time' name='working_end' value='00:00:00'>
                                    </div>
                                </div>
                                <button onclick=\"Update(this,'dentist')\" type='button' class='btn btn-outline' style='margin-top:15px;'>Save</button>
                                <div class='message alert'></div>
                            </form>
                        </div>
                        
                        
                        ";
                    }
                ?>
                <div class="section-header">
                    <h2 class="wow fadeInDown animated">Our Doctors</h2>
                </div>
                <div>
                    
                    <?php
                        for ($i=0; $i < sizeof($dentists); $i++) { 
                            $value = $dentists[$i];
                            echo "               
                            <div class='col-md-3 col-sm-6'>
                                <div class='person'>
                                <img src='$imgURL/$value[picture]' alt='' class='img-responsive'>
                                <div class='person-content'>
                                    <form>
                                        <h4>$value[dentist]</h4>
                                        <h5 class='role'>$value[specialization]</h5>
                                        ".($value['name'] != "" ? "<label>Services</label><div>$value[name] : $value[price] € - $value[length] min.</div>" : '') ."
                                        
                                        <br>
                                        <label>Working hours</label>
                                        <div>$value[working_start] - $value[working_end]</div>
                                        <br>
                                        ";

                                        if($admin){
                                            echo "
                                            <input type='text' style='display:none;' name='id' value='$value[id]'>
                                            <label>Update service</label>
                                            <select class='form-control' name='service'>
                                                ";
    
                                                for ($i=0; $i < sizeof($services); $i++) { 
                                                    $service = $services[$i];
                                                    echo "<option value='$service[id]'>$service[name]</option>";
                                                }
                                                
                                                echo"
                                            </select>
                                            <button onclick=\"UpdateService(this,'dentist')\" type='button' class='btn btn-outline' style='margin-top:15px;'>Save</button>
                                            <div class='message alert'></div>
                                            ";
                                        }
                                        echo "
                                    </form>
                                </div>
                                ";
                                if($quest){
                                    echo "<button type='button' class='btn btn-primary' onclick='OpenDialog(this)' style='margin-top:15px;'>Book</button>";
                                    echo "
                                    <div class='modal book'>
                                        <div class='modal-dialog' role='document'>
                                            <form>
                                                <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='exampleModalLabel'>Booked dates:</h5>
                                                </div>
                                                <div class='modal-body'>
                                                    ";
                                                    if($value['time'] != "") {
                                                        $time = explode(",",$value['time']);
                                                        $date = explode(",",$value['date']);
                                                        $active = explode(",",$value['active']);
        
                                                        echo "
                                                        <table class='table'>
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'></th>
                                                                    <th scope='col'>Date</th>
                                                                    <th scope='col'>Time</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";
                                                                for ($d=0; $d < sizeof($time); $d++) { 
                                                                    if($active[$d] != 0){
                                                                        echo "
                                                                            <tr>
                                                                                <th scope='row'></th>
                                                                                <td>$date[$d]</td>
                                                                                <td>$time[$d]</td>
                                                                            </tr>
                                                                        ";
                                                                    }
                                                                };
                                                                echo "
                                                            </tbody>
                                                        </table>";
                                                    }
                                                    echo "
                                                        <div class='row' style='display:flex; gap:25px;'>
                                                            <div style='display:none;'>
                                                                <input class='form-control' type='text' value='$value[id]' name='dentist'>
                                                            </div>
                                                            <div style='flex-basis:49%;'>
                                                                <input class='form-control' type='date' name='date'>
                                                            </div>
                                                            <div style='flex-basis:49%;'>
                                                                <input class='form-control' type='time' name='time'>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <div class='message alert'></div>
                                                        <button type='button' onclick='OpenDialog(this)' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                        <button type='button' onclick=\"Book(this, 'dentist')\" class='btn btn-primary'>Book</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                                }
                                
                                
                                echo "
                                </div>
                            </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
            if($admin){

                echo "
                <div id='tabs-2' class='section'>
                    <center>
                        <button onclick='AddService()'  class='btn btn-primary' style='margin:0 0 15px;'>Add service</button>
                    </center>
                    <div>            
                        <div class='services'>
                        ";
                                for ($i=0; $i < sizeof($services); $i++) { 
                                    $value = $services[$i];
                                    echo "
                                    <div>
                                        <form>
                                        <h4 style='text-align:center;'>$value[name]</h4>
                                        <div style='display:flex; gap:25px; justify-content:center;'>
                                            <div style='display:none;'>
                                                <input class='form-control' type='text' name='id' value='$value[id]'>
                                            </div>
                                            <div>
                                                <label for='name'>Name</label>
                                                <input class='form-control' type='text' name='name' value='$value[name]'>
                                            </div>
                                            <div>
                                                <label for='length'>Duration in minutes</label>
                                                <input class='form-control' type='text' name='length' value='$value[length]'>
                                            </div>
                                            <div>
                                                <label for='price'>Price</label>
                                                <div style='display:flex; align-items:center; gap:15px;'>
                                                    <input class='form-control' type='text' name='price' value='$value[price]'>
                                                    <span>€</span>
                                                </div>
                                            </div>
                                            <div>
                                                <button type='button' onclick=\"Update(this,'service')\" class='btn btn-primary' style='margin-top:15px;'>Save</button>
                                                <button type='button' onclick=\"DeleteEntry(this,'service')\" class='btn btn-primary' style='margin-top:15px;'>Delete</button>
                                                <div class='message alert'></div>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                    ";
                                }
                                echo "
                        </div>
                    </div>
                </div>             
                ";
            }
        ?>

        <?php
            if($dentist){
                $service = []; 
                for ($i = 0;$i < sizeof($services);$i++)
                {
                    $value = $services[$i];
                    $service[] = $value['name'];
                }
                $service = join(",",$service);

                echo "
                <div id='tabs-3' class='section'>
                    <div style='display:flex;justify-content: center;'>
                        <form>
                        <div>
                            <select class='form-control' style='display:block;' onchange=\"getThreatments(this)\" name='id'>
                            <option value='' disabled selected>Select your option</option>
                            ";
                                for ($i=0; $i < sizeof($users); $i++) { 
                                    $value = $users[$i];
                                    echo "
                                        <option value='$value[id_user]'>$value[email] -- $value[negative_points] negative points</option>
                                    ";
                                }
                            echo "
                            </select>
                            <button onclick=\"AddThreatment(this, '$service')\" type='button' class='btn btn-primary' style='margin-top:10px;'  ".(sizeof($users) > 0 ? "" : "disabled='true'")." style='margin:0 0 15px;'>Add threatment</button>
                            <button onclick=\"AddNegativePoints(this)\" type='button' class='btn btn-primary' style='margin-top:10px;' ".(sizeof($users) > 0 ? "" : "disabled='true'")." style='margin:0 0 15px;'>Add negative points</button>
                        </div>
                        </form>
                    </div>
                    <div>            
                        <center class='threatment'>
                        </center>
                    </div>
                </div>             
                ";
            }
        ?>

        <?php
            if($admin){
                $service = []; 
                for ($i = 0;$i < sizeof($services);$i++)
                {
                    $value = $services[$i];
                    $service[] = $value['name'];
                }
                $service = join(",",$service);
                echo "
                <div id='tabs-3' class='section'>
                    <div style='display:flex; justify-content:center;'>
                        <form style='flex:1; padding:0 30%;'>
                        <div style='display: flex;justify-content: center;flex-direction: column;'>
                            <select class='form-control' style='display:block;' onchange=\"getThreatments(this)\" name='id'>
                            <option disabled selected>Select</option>
                            ";
                                for ($i=0; $i < sizeof($users); $i++) { 
                                    $value = $users[$i];
                                    echo "
                                        <option value='$value[id_user]'>$value[email]</option>
                                    ";
                                }
                            echo "
                            </select>
                            <button onclick=\"CancelUser(this, 'users')\" type='button' ".(sizeof($users) > 0 ? "" : "disabled='true'")." class='btn btn-primary' style='margin:15px 0;'>Block / Unblock user</button>
                            <div class='message alert'></div>
                        </div>
                        </form>
                    </div>
                    <div>            
                        <center class='threatment'>
                        </center>
                    </div>
                </div>             
                ";
            }
        ?>

        <?php   
            if($admin){
                $service = []; 
                for ($i = 0;$i < sizeof($services);$i++)
                {
                    $value = $services[$i];
                    $service[] = $value['name'];
                }
                $service = join(",",$service);

                echo "
                <div id='tabs-4' class='section'>
                    <center>
                        <form style='flex:1; padding:0 30%;'>
                        <div style='display: flex;justify-content: center;flex-direction: column;'>
                            <input class='form-control' type='date' onchange=\"getAppointment(this)\" name='date'>
                            <div class='message alert'></div>
                        </div>
                        </form>
                    </center>
                    <div>            
                        <center class='appointment'>
                        </center>
                    </div>
                </div>             
                ";
            }
        ?>
      </div>
   </body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery.flexslider-min.js"></script>
   <script src="js/jquery.fancybox.pack.js"></script>
   <script src="js/modernizr.js"></script>
   <script src="js/main.js"></script>
   <script src="../main.js"></script>
   <script type="text/javascript" src="js/jquery.contact.js"></script>
   <script type="text/javascript" src="js/jquery.devrama.slider.min-0.9.4.js"></script>

   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
    $( function() {
        $( "#tabs" ).tabs({
        
        });
    } );
    </script>
</html>