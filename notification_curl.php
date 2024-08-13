<?php
session_start();
error_reporting(0);
require_once("db.php");
date_default_timezone_set('Asia/Kolkata');
$logPath = "log/dlrnotification_curl".date("Ymd").".txt";
error_log(date('Ymd His')." :  requested url:".$_SERVER['REQUEST_URI']."\n", 3, $logPath);

$username = $_GET['username'];
$password = $_GET['password'];
$msisdn = $_GET['msisdn'];
$actionType = $_GET['actionType'];
$serviceId = $_GET['serviceId'];
$spId = $_GET['spId'];
$date = $_GET['date'];
$requestid = $_GET['requestid'];
$sc = $_GET['sc'];

$pubidget="select * from tbl_wapidentify_ZainIQ where msisdn='$msisdn' order by id desc limit 1";	
	$sentCount22=mysqli_query($con1,$pubidget);
	$mis_arrayy=mysqli_fetch_assoc($sentCount22);
	$pubid = $mis_arrayy['pubid'];
	$subid = $mis_arrayy['subid'];
	$campid = $mis_arrayy['campid'];
error_log("lastid:".date('Ymd His').": ". $lastid."\n", 3, $logPath);


if($actionType=="1"){
	#campid
	#pubid // activation request
	$referID=date("ymdHisu");
	
		  
	$duplicate="select count(*) as cnt from tbl_subscription_zainIQ where msisdn='$msisdn' and date(lastupdatedate)=date(now()) and actionType=1 order by id desc";
$duplicateResult=mysqli_query($con1,$duplicate);
	
	while($mis_array=mysqli_fetch_assoc($duplicateResult)) {
		$count = $mis_array['cnt'];
	}
if($count=='0')
{
	$text="https://www.esports.playme.in.net/myaccountzainIQ.php?msisdn=$msisdn";
 
    $msg=bin2hex(mb_convert_encoding($text, 'UCS-2', 'auto'));
	
	$url="https://services.mediaworldiq.com:456/dcb/API/DCB-SMS/actions/sendDCBSMS?user=enyoglobal&password=eny0gl0b@l22&msisdn=$msisdn&shortcode=3368&serviceId=422&spId=133&msg=$msg&alphanumeric=games24&spTransactionId=$referID";
error_log(date('Ymd His')." :  url : $url\n", 3, $logPath);
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => ''.$url.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));
$response = curl_exec($curl);
error_log(date('Ymd His')." :  response : $response\n", 3, $logPath);
curl_close($curl);
	
	$Query="insert into tbl_subscription_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values (now(),'$msisdn','$pubid','$date','ACT-REQ',DATE_SUB($date, INTERVAL -1 DAY),'$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','0','$subid')";
	

	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }

	$Query="insert into tbl_subscription_trans_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values (now(),'$msisdn','$pubid','$date','ACT-REQ',DATE_SUB($date, INTERVAL -1 DAY),'$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','0','$subid')";
	


	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		  
		/*  if($campid!=''&&$subid!=''&&$subid!="Inapp"){
		  $urlcallback="https://www.esports.playme.in.net/zainIQEsports_callback.php?msisdn=$msisdn";
		  error_log("urlcallback:".date('Ymd His').": ". $urlcallback."\n", 3, $logPath);	
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL,$urlcallback);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
				$output=curl_exec($ch);
				curl_close($ch);
          error_log("response:".date('Ymd His').": ".date("Ymd hms")." url:". $output."\n", 3, $logPath);
		//echo "workingnew";		
		}*/
    $current_timestamp = time();
	$back_timestamp = $current_timestamp - (10 * 60 * 60);
	$back_date_time = date("His", $back_timestamp);
	if($back_date_time>=000001 && $back_date_time<235900)
	{
    if($campid!=''&&$subid!=''&&$subid!="Inapp"){
		$pubidget1="select cap from cap_logic_zainIQ_playme where capname='capcounter'";	
	    $sentCount222=mysqli_query($con1,$pubidget1);
	    $mis_arrayy=mysqli_fetch_assoc($sentCount222);
	    $capcounter = $mis_arrayy['cap'];
        error_log("capcounter:".date('Ymd His').": ". $capcounter."\n", 3, $logPath);

        $pubidget2="update cap_logic_zainIQ_playme set cap=$capcounter+1 where capname='capcounter'";	
	    $sentCount223=mysqli_query($con1,$pubidget2);
	    $mis_arrayy=mysqli_fetch_assoc($sentCount223);
	    $capcounter = $mis_arrayy['cap'];
        error_log("capcounter:".date('Ymd His').": ". $capcounter."\n", 3, $logPath);		
	}	
	}	
}

else {
	//$counter='0';
}
		  

	
}
else if($actionType=="2") {
	
	    $Querypubrenew = "select  * from tbl_subscription_zainIQ where msisdn='$msisdn' order by  id desc limit 1";
        error_log(date('Ymd His')." : Querypubrenew:".$Querypubrenew."\n", 3, $logPath);
		$resultpubrenew=mysqli_query($con1,$Querypubrenew);
		while($mis_arraypub=mysqli_fetch_assoc($resultpubrenew)) {			
			$finddate = $mis_arraypub['regdate'];
		}
		
		///////////////////////// if find date is not presense////////////////
		if($finddate=='')
		{
			$statuss='FSC-BL';
			$finddate="now()";
			$Query="insert into tbl_subscription_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values (now(),'$msisdn','$pubid',$finddate,'$statuss',DATE_SUB($date, INTERVAL -1 DAY),'$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','300','$subid')";
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		  
		  $Query="insert into tbl_subscription_trans_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values (now(),'$msisdn','$pubid',$finddate,'$statuss',DATE_SUB($date, INTERVAL -1 DAY),'$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','300','$subid')";
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		
        if($campid!=''&&$subid!=''&&$subid!="Inapp"){
		  $urlcallback="https://www.esports.playme.in.net/zainIQEsports_callback.php?msisdn=$msisdn";
		  error_log("urlcallback:".date('Ymd His').": ". $urlcallback."\n", 3, $logPath);	
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL,$urlcallback);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
				$output=curl_exec($ch);
				curl_close($ch);
          error_log("response:".date('Ymd His').": ".date("Ymd hms")." url:". $output."\n", 3, $logPath);
		//echo "workingnew";		
		}		
		  
		}
		///////////////////////// if find date is not presense////////////////
		else
		{
			$duplicatee="select * from tbl_subscription_zainIQ where msisdn='$msisdn' and actionType in ('2','3')  order by id desc";
			error_log("duplicatee:".date('Ymd His').": ". $duplicatee."\n", 3, $logPath);
		$duplicatenume=mysqli_query($con1,$duplicatee);
		while($mis_arraynumm=mysqli_fetch_assoc($duplicatenume)) {			
			$actionTypeval = $mis_arraynumm['actionType'];
		}
		error_log("actionTypeval:".date('Ymd His').": ". $actionTypeval."\n", 3, $logPath);
		if($actionTypeval=='')
		{
			/////////fsc-bl
			$statuss='FSC-BL';
			$Query="update  tbl_subscription_zainIQ set lastupdatedate=now(),regdate='$finddate',serviceId='$serviceId',statuss='$statuss',validitydate=DATE_SUB($date, INTERVAL -1 DAY),requestid='$requestid',actionType='$actionType',campid='$campid',price='300',subid='$subid' where msisdn='$msisdn'" ;
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		  
		  $Query="insert into tbl_subscription_trans_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values (now(),'$msisdn','$pubid','$finddate','$statuss',DATE_SUB($date, INTERVAL -1 DAY),'$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','300','$subid')";
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		
        if($campid!=''&&$subid!=''&&$subid!="Inapp"){
		  $urlcallback="https://www.esports.playme.in.net/zainIQEsports_callback.php?msisdn=$msisdn";
		  error_log("urlcallback:".date('Ymd His').": ". $urlcallback."\n", 3, $logPath);	
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL,$urlcallback);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
				$output=curl_exec($ch);
				curl_close($ch);
          error_log("response:".date('Ymd His').": ".date("Ymd hms")." url:". $output."\n", 3, $logPath);
		//echo "workingnew";		
		}
		
		}else
		{
			////////renew -success
			$statuss='RENEW-SUCCESS';
			$Query="update  tbl_subscription_zainIQ set lastupdatedate=now(),regdate='$finddate',serviceId='$serviceId',statuss='$statuss',validitydate=DATE_SUB($date, INTERVAL -1 DAY),requestid='$requestid',actionType='$actionType',campid='$campid',price='300',subid='$subid' where msisdn='$msisdn'" ;
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		  
		  $Query="insert into tbl_subscription_trans_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values (now(),'$msisdn','$pubid','$finddate','$statuss',DATE_SUB($date, INTERVAL -1 DAY),'$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','300','$subid')";
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
			
		}
			
		
		}	
		
}
else if($actionType=="3") {	
	    $Querypubrenew = "select  * from tbl_subscription_trans_zainIQ where msisdn='$msisdn' order by  id desc limit 1";
        error_log(date('Ymd His')." : Querypubrenew:".$Querypubrenew."\n", 3, $logPath);
		$resultpubrenew=mysqli_query($con1,$Querypubrenew);
		while($mis_arraypub=mysqli_fetch_assoc($resultpubrenew)) {			
			$finddate = $mis_arraypub['regdate'];
		}
		
		if($finddate=='')
		{
			$finddate="now()";
		}else
		{
			$finddate="'".$finddate."'";
		}
	
	    $Query="insert into tbl_subscription_trans_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values ($date,'$msisdn','$pubid',$finddate,'LOW-BL','$date','$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','0','$subid')";
		error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		

}

else if($actionType=="0" ){
	
	    $Querypubrenew = "select  * from tbl_subscription_trans_zainIQ where msisdn='$msisdn' order by  id desc limit 1";
        error_log(date('Ymd His')." : Querypubrenew:".$Querypubrenew."\n", 3, $logPath);
		$resultpubrenew=mysqli_query($con1,$Querypubrenew);
		while($mis_arraypub=mysqli_fetch_assoc($resultpubrenew)) {			
			$finddate = $mis_arraypub['regdate'];
		}
	
		$Query="insert into tbl_subscription_trans_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values ($date,'$msisdn','$pubid','$finddate','DEACTIVATED','$date','$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','0','$subid')";
	

	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		  
		  $Query="delete from tbl_subscription_zainIQ where msisdn='$msisdn'" ; 
	

	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }

	
}
else {
		$Query="insert into tbl_subscription_trans_zainIQ(lastupdatedate,msisdn,pubid,regdate,statuss,validitydate,username,password,actionType,serviceId,spId,requestid,sc,campid,price,subid) values ($date,'$msisdn','$pubid','$date','$actionType','$date','$username','$password','$actionType','$serviceId','$spId','$requestid','$sc','$campid','0','$subid')";
	

	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
}


echo 'OK';

?>