<?php
session_start();
error_reporting(0);
require_once("db.php");
$logPath = "log/zainIQEsports_callback_".date("Ymd").".txt";

	error_log("requested url ".date('Ymd His')."".$_SERVER['REQUEST_URI']."\n", 3, $logPath);
 $msisdn = $_GET['msisdn'];
	
	$Query = "select * from  tbl_wapidentify_ZainIQ where msisdn='$msisdn' and sentnotsent='notsent' and date(entrydate)=date(now()) order by id desc limit 1";
error_log("Query=".date('Ymd His')."".$Query."\n", 3, $logPath);
		$result=mysqli_query($con1,$Query);
		while($mis_array=mysqli_fetch_assoc($result)) {			
			$subid = $mis_array['subid'];
			$pubid = $mis_array['pubid'];
			$campid = $mis_array['campid'];		
		}
		error_log("subid=".date('Ymd His')."".$subid."\n", 3, $logPath);

		if($subid!=''&&$subid!="Inapp")
		{
			$Querysuccess="insert into zainIQEsportssubbaseentbox(entrydate,msisdn,mode,pubid,subid,campid) values (now(),'$msisdn','0','$pubid','$subid','$campid')";
	error_log("Querysuccess:".date('Ymd His').": ". $Querysuccess."\n", 3, $logPath);
	
		if(!mysqli_query($con1,$Querysuccess))
		  {
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
		
		$url1="http://139.59.3.239:8080/exchange/pubrequest?kp=$subid&pid=$campid";
		error_log("Called url=".date('Ymd His')."".$url1."\n", 3, $logPath);
		$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url1);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$output=curl_exec($ch);
			curl_close($ch);
		error_log("Called url output=".date('Ymd His')."".$output."\n", 3, $logPath);
					
		error_log("final view:".date('Ymd His').": we show publisher $output \n", 3, $logPath);
		die;
				  	
		}
		
?>