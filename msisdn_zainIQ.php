<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="forntEnd-Developer" content="Mamunur Rashid">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Games24</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- Plugin css -->
	<link rel="stylesheet" href="assets/css/plugin.css">

	<!-- stylesheet -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">
	<link rel="stylesheet" href="new_css_file/suraj.css" />
	<style>
	select {
	background-color: transparent!important;
    color: #fff!important;
	}
	label {
	color:#fa009f
	}
	.single-turnaments {
	margin-top:100px
	}
	</style>
</head>
<body>
	<!-- preloader area start -->
	<div class="preloader" id="preloader">
		<div class="loader loader-1">
			<div class="loader-outter"></div>
			<div class="loader-inner"></div>
		</div>
	</div>
	<!-- preloader area end -->
<header class="header">
		<div class="overlay"></div>
				<div class="mainmenu-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">                 
						<nav class="navbar navbar-expand-lg navbar-light">
							<a class="navbar-brand" href="https://www.esports.playme.in.net/promo.php?sid=422">
								<img src="assets/images/logo.png" alt="">
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse fixed-height" id="main_menu">
								<ul class="navbar-nav ml-auto">
									
									<li class="nav-item">
										<a class="nav-link" href="https://www.esports.playme.in.net/promo.php?sid=422">Home</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="myaccountzainIQ.php">My Account</a>
									</li>
									
								</ul>
								
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
</header>
	<!-- Header Area End  -->
	<script type="text/javascript">
		function change_url() {
			 var lang = $('#record option:selected').val();
			 window.location.href = 'index.php?lang='+lang;
		}
</script>

<section class="breadcrumb-area contact">
	</section>
	
		<section class="contact-section">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-12">
					<div class="contact-area">
						<div class="row">
							<div class="col-lg-12">
							<center>
<p style="color:white;"><b>Welcome To Games24</b></p>
<br>
<form action="myaccountzainIQ.php">
<b> <p style="color:white;"> Please Enter Your Mobile Number To Enjoy The Service</p></b><br>

<br>
<input name="country_code" size="3" value="964" style="font-size: 14px;border: 1px solid #ccc;padding: 6px 2px;width: 10%" readonly=""> -
          <input type="text" style=" border: 1px solid #ccc;padding: 6px 12px;width: 60%;" name="msisdn" placeholder = "Please Enter Your Mobile Number" pattern="[0-9]{3,13}" title="Invalid mobile number" required="">

 <br>
 <input id="idr" name="t" type="hidden" value="<?php echo $t ?>">
 <br>
  <input type="submit" value="Proceed">
</form> 
</center>
<br>
<br>
								
							</div>
						</div>
						<div class="row justify-content-between align-items-center">
							
							<div class="col-lg-5">
								<div class="right-area">
									<div class="top-content">
										<!-- <h4>Have questions?</h4> -->
										
										
									</div>
									<div class="bottom-content">
										
										<!--<div class="single-info">
											<div class="icon">
												<i class="fas fa-phone"></i>
											</div>
											<div class="content">
												<h4>Email Us</h4>
												<p>+1 (987) 664-32-11</p>
												<p>+1 (987) 694-32-11</p>
											</div>
										</div> -->
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include "footer.php"; ?>






