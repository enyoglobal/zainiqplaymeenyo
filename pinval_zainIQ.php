<?php 
session_start();
error_reporting(0);
$logPath = "log/pinval_".date("Ymd").".txt";
error_log(date('Ymd His')." : requested url:".$_SERVER['REQUEST_URI']."\n", 3, $logPath);
$refid=date("ymdHisu");
$lastid=$_GET['lastid'];
$otp=$_GET['otp'];
$msisdn = $_GET['msisdn'];
$transid=date("ymdHisu");

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://services.mediaworldiq.com:456/dcb/API/VMS-DCBSubscription/actions/verifyPincode?user=enyoglobal&password=eny0gl0b@l22&msisdn='.$msisdn.'&shortcode=3368&serviceId=422&spId=133&pincode='.$otp.'',
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
					header("Location:thankyou_zainIQ.php?message=sub");
					die;										
				}else{
						header("Location:failure_zainIQ.php?message=$result&status=$status");
					die;			
				}


?>