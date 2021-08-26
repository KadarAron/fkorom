<?php
session_start();
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

?>

<!doctype html>
<html class="no-js" lang="">

<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dentist Website / Joo Martin && Kadar Aron</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/font-icon.css">
<link rel="stylesheet" href="css/animate.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
</head>

<body>
<!-- header section -->
<section class="banner" role="banner">
  <header id="header">
    <div class="header-content clearfix"> <a class="logo" href="index.php"><i class="icon icon-anchor"></i> Dentist</a>
      <nav class="navigation" role="navigation">
        <ul class="primary-nav">
    		  <li><a href="#banner">Home</a></li>
          <li><a href="./dentists/index.php">Doctors</a></li>
          <?php
                echo $quest ? "<li class='nav-item'>
                <a class='nav-link' href='./profile'>Profile</a></li>" : "";
            ?>
            <?php
                echo $loggedIn ? "<li class=\"nav-item\"><a class=\"nav-link\" href='./register/logout.php'> <button type='button' class='btn btn-outline-light' >Log out</button></a></li>" 
                : "
                  <a href='register/index.php'> <button type='button' class='btn btn-outline-light my-2 my-sm-0' >Sign Up</button></a>
                ";
          ?>
        </ul>
      </nav>
      <a href="#" class="nav-toggle">Menu<span></span></a> </div>
  </header>
  <!-- banner text --> 
    <div class="banner" id="banner"> 
	<div class="slider-banner">
            <div data-lazy-background="images/slides/1.jpg"> 
                <h3 data-pos="['68%', '-40%', '60%', '12%']" data-duration="700" data-effect="move">
                    Dental Clinic
                </h3> <br>
                <p data-pos="['75%', '110%', '75%', '12%']" data-duration="700" data-effect="move"><br>
                    Best choice for you!
                </p> 
            </div>
            <div data-lazy-background="images/slides/3.jpg"> 
                <h3 data-pos="['75%', '-40%', '60%', '12%']" data-duration="700" data-effect="move">
                    Beautiful Smile
                </h3> <br>
                <p data-pos="['75%', '110%', '75%', '12%']" data-duration="700" data-effect="move"><br>
                    Your teeth will thank you <br> for the trust you have placed in us!
                </p>
            </div>
             
        </div>
      <!-- banner text --> 
    </div> 
</section>
<!-- header section --> 
<!-- intro section -->
<section id="intro" class="section intro">
  <div class="container">
    <div class="col-md-8 col-md-offset-2 text-center">
      <h3>Welcome to Smile Zone</h3>
      <p>
          Thank you for visiting our site and we are sure you will find what is best for you!<br> We have the most qualified doctors, you can feel safe and smile happier, you don't have to worry about not being taken care of.</p>
	<div class="site-info">
		<div class="phoneInfo"><h6>Call Today: </h6><a href="#">066-666-666</a></div>
		<div class="timeInfo"><h6>Opening Hours: </h6> <em>Mon–Fri: 8am–6pm; Sun: 9am–1pm</em></div>
	</div>   
   </div>
  </div>
</section>
<!-- intro section --> 

<!--About-->
<section id="content-3-10" class="content-block data-section nopad content-3-10">
	<div class="image-container col-sm-6 col-xs-12 pull-left">
		<div class="background-image-holder">

		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-6 col-xs-12 content">
				<div class="editContent">
					<h3>Why our Dentist?</h3>
				</div>
				<div class="editContent">
				<strong>Personalized Care</strong>
					<p>We have a separate doctor for each dental problem, so you can be sure that you are getting the most appropriate treatment.</p>
					<strong>Specialist Driven</strong>
					<p>We have been the most reliable dental practice for 5 years, and this is due to the training of our doctors. Choose us and make sure.</p>
				</div>
				<a href="#gallery" class="btn btn-outline btn-outline outline-dark">Our Gallery</a>
			</div>
		</div><!-- /.row-->
	</div><!-- /.container -->
</section>

<!-- gallery section -->
<section id="gallery" class="gallery section">
  <div class="container-fluid">
    <div class="section-header">
                <h2 class="wow fadeInDown animated">Gallery</h2>
                <p class="wow fadeInDown animated"></p>
            </div>
    <div class="row no-gutter">
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/01.jpg" class="work-box"> <img src="images/portfolio/01.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
             <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/02.jpg" class="work-box"> <img src="images/portfolio/02.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/03.jpg" class="work-box"> <img src="images/portfolio/03.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/04.jpg" class="work-box"> <img src="images/portfolio/04.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption"> 
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/05.jpg" class="work-box"> <img src="images/portfolio/05.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/06.jpg" class="work-box"> <img src="images/portfolio/06.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/07.jpg" class="work-box"> <img src="images/portfolio/07.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/08.jpg" class="work-box"> <img src="images/portfolio/08.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
             <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
    </div>
  </div>
</section>
<!-- gallery section --> 

<!-- Testimonials section -->
<section id="testimonials" class="section testimonials no-padding">
  <div class="container-fluid">
    <div class="row no-gutter">
      <div class="flexslider">
        <ul class="slides">
          <li>
            <div class="col-md-12">
              <blockquote>
                <h1>"I believe I can make your life happier with my work." </h1>
                <p>Jonh Dow</p>
              </blockquote>
            </div>
          </li>
          <li>
            <div class="col-md-12">
              <blockquote>
                <h1>"The real doctor who monitors both the patient and the disease." </h1>
                <p>Marcus Linn</p>
              </blockquote>
            </div>
          </li>
          <li>
            <div class="col-md-12">
              <blockquote>
                <h1>"Many people believe that with a degree we will be good doctors, but we will achieve this over time." </h1>
                <p>Chris Jemes</p>
              </blockquote>
            </div>
          </li>
          <li>
            <div class="col-md-12">
              <blockquote>
                <h1>"From there, you know you’re facing the wrong doctor, he treats everyone equally" </h1>
                <p>Vintes Mars</p>
              </blockquote>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- Testimonials section --> 


<!-- JS FILES -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.flexslider-min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/modernizr.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript" src="js/jquery.contact.js"></script>
<script type="text/javascript" src="js/jquery.devrama.slider.min-0.9.4.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$('.slider-banner').DrSlider({
				'transition': 'fade',
				showNavigation: false,
				progressColor: "#03A9F4"
			});
		});
	</script>
</body>
</html>