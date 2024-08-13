<?php
session_start();
error_reporting(0);
require_once("db.php");
$logPath = "log/my_account".date("Ymd").".txt";
error_log("called url: ".date('Ymd His').": ".$_SERVER['REQUEST_URI']."\n", 3, $logPath);

error_log("act:".date('Ymd His').": ". $_SESSION['act']."\n", 3, $logPath);	
error_log("msisdn:".date('Ymd His').": ". $_SESSION['msisdn']."\n", 3, $logPath);	

$msisdn =$_SESSION['msisdn'];
error_log(date('Ymd His').": value of msisdn in first step = $msisdn\n", 3, $logPath);

if(!empty($_GET['msisdn']))
    {
		
  $msisdn = $_GET['msisdn'];
  if($msisdn!="")
{	
$msisdn = substr($msisdn, -10);
$msisdn='964'.$msisdn;
  //$msisdn =$msisdn;  
}
$qry = "select * from tbl_subscription_zainIQ where msisdn = '$msisdn'";

  $result = mysqli_query($con1,$qry);
  if (!$result) {
    echo mysqli_error();
  }
  $isSubscribed = mysqli_num_rows($result);

  //echo 'isSubscribed'.$isSubscribed;
  //echo 'qry'.$qry;
  
  if($isSubscribed > 0) {
    $_SESSION['act'] ="1";
    $_SESSION['msisdn']=$msisdn;
   header("Location:https://www.esports.games24.in/index.php?lang=ar&status=true");

  } else {
     $_SESSION['msisdn'] = $msisdn;
  }

}
$msisdn=$_SESSION['msisdn'];

		
	

if($msisdn=="")
{
	header("Location:msisdn_zainIQ.php");
}



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
							<a class="navbar-brand" href="https://www.esports.games24.in/index.php?lang=ar">
								<img src="assets/images/logo.png" alt="">
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse fixed-height" id="main_menu">
								<ul class="navbar-nav ml-auto">
									
									<li class="nav-item">
										<a class="nav-link" href="https://www.esports.games24.in/index.php?lang=ar">Home</a>
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
							<?php

if($_SESSION['act']=='1')
						{
	$Query = "select  * from tbl_subscription_zainIQ where msisdn = '$msisdn'";
    error_log(date('Ymd His')." : called Query  $Query \n", 3, $logPath);
		$result=mysqli_query($con1,$Query);
		while($mis_array=mysqli_fetch_assoc($result)) {			
			$regdate = $mis_array['regdate'];
			$validitydate = $mis_array['validitydate'];
			$statuss = $mis_array['statuss'];
			$requestid = $mis_array['requestid'];
			$serviceId = $mis_array['serviceId'];
			$actionType = $mis_array['actionType'];	
		}
        

$idd="00".date("ymdHisu");
		 $action2 ="https://www.esports.games24.in/unsub_zainIQ.php?msisdn=$msisdn";

		 ?>
        
        
<h5>Welcome User</h5>
<p> You are our prime member</p>

<h5>Subscription</h5>
<p>Start date :<?php echo $regdate;   ?></p>
<p>Status :Active</p>
<p>Click Here to view the content <b><u><a href="https://www.esports.games24.in/index.php?lang=ar&status=true">Here</a></u></b></p>
<div class="left-area">
<center>
<button class="button button3" onclick="location.href='<?php echo $action2;?>'">Unsubscribe</button>
</center>
</div>
<?php } else {
	
	$action1="https://www.esports.games24.in/promo.php?sid=422";
	?>
	<h5>Welcome User</h5>
<p> You are not Subscribed user of our service, Please click on subscribe now button for subscription.</p>
<div class="left-area">
<center>
<button class="button button3" onclick="location.href='<?php echo $action1;?>'">Subscribe Now</button> 
</center>
</div>
<?php } ?>

								
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






