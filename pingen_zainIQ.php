<?php 
session_start();
error_reporting(0);
require_once("db.php");
$logPath = "log/pingen_".date("Ymd").".txt";
error_log(date('Ymd His')." : requested url:".$_SERVER['REQUEST_URI']."\n", 3, $logPath);
$refid=date("ymdHisu");
$msisdn = $_GET['msisdn'];
$msisdn = substr($msisdn, -10);
$msisdn ='964'.$msisdn;
$lastid = $_GET['lastid'];

$Queryupdate="update tbl_wapidentify_ZainIQ set msisdn='$msisdn' where id=$lastid";
	error_log("Queryupdate:".date('Ymd His').": ". $Queryupdate."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Queryupdate))
		  {
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
	

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://services.mediaworldiq.com:456/dcb/API/VMS-DCBSubscription/actions/sendPincode?user=enyoglobal&password=eny0gl0b@l22&msisdn='.$msisdn.'&shortcode=3368&serviceId=422&spId=133',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
//die;

            $data = json_decode($response);
			$status=$data->status;
			$result=$data->msg;	
  error_log(date('Ymd His')." success=$status ,message=$result\n", 3, $logPath);


if($status=='Success')
				{
					header("Location:otp_zainIQ.php?lastid=$lastid&msisdn=$msisdn");
					die;					
				}else{
					header("Location:failure_zainIQ.php?message=$result");
					die;									
				}


?>