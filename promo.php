<?php
session_start();
error_reporting(0);
require_once("db.php");
date_default_timezone_set('Asia/Kolkata');
$logPath = "log/clickreceive_".date("Ymd").".txt";
error_log("called url: ".date('Ymd His')." : ".$_SERVER['REQUEST_URI']."\n", 3, $logPath);

$pubid = $_GET['pubid'];
$campid = $_GET['id'];
$req = $_GET['req'];
$subid = $_GET['subid'];
$referID=date("ymdHisu");

if($_GET['sid']=='422')
    {	 
     $current_timestamp = time();
	 $back_timestamp = $current_timestamp - (10 * 60 * 60);
	 $back_date_time = date("His", $back_timestamp);
	 //$offset = -1;
	 //$back_date_time1 = date("Y-m-d", $current_timestamp);
	 //$back_date_time11 = date("Y-m-d", strtotime("$offset day"));
	 
     //$qry2 = "select count(*) as cnt from tbl_subscription_trans_zainIQ WHERE ((DATE_FORMAT(lastupdatedate, '%H:%i') >= '10:00' AND DATE(lastupdatedate) = '$back_date_time11') OR (DATE_FORMAT(lastupdatedate, '%H:%i') < '09:59' AND DATE(lastupdatedate) = '$back_date_time1')) and statuss='ACT-REQ' and campid!=''";
	 $pubidget1="select cap from cap_logic_zainIQ_playme where capname='capcounter'";	
	 error_log(date('ymdHisu')." qry2 : $pubidget1 \n", 3, $logPath);
	 $sentCount222=mysqli_query($con1,$pubidget1);
	 $mis_arrayy=mysqli_fetch_assoc($sentCount222);
	 $capcounter = $mis_arrayy['cap'];
     error_log("capcounter:".date('Ymd His').": ". $capcounter."\n", 3, $logPath);

	 $qry21 = "select cap as cnt from cap_logic_zainIQ_playme where capname='cap'";
	 error_log(date('ymdHisu')." qry21 : $qry21 \n", 3, $logPath);
	 $TotalActiveBaseResult31=mysqli_query($con1,$qry21);
	 while($mis_array=mysqli_fetch_assoc($TotalActiveBaseResult31)) {
	 	$TotalActiveLogicHits = $mis_array['cnt'];
	 }	
	 error_log(date('ymdHisu')." : TotalActiveLogicHits : $TotalActiveLogicHits \n", 3, $logPath);
	 if($capcounter<=$TotalActiveLogicHits)
	 {
	  error_log(date('ymdHisu')." cap is NOT OVER  : \n", 3, $logPath);
	  $Query="insert into tbl_wapidentify_ZainIQ (referid,entrydate,pubid,subid,campid) values ('$referID',now(),'$campid','$subid','$campid')";
	  error_log(date('Ymd His')." : Query=$Query \n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {
			error_log("Error description:".date('Ymd His')." : ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
          $lastid = mysqli_insert_id($con1);		  
         error_log(date('Ymd His')."redirected to lp page: \n", 3, $logPath);
	if($back_date_time>=000001 && $back_date_time<235900)
	{
		error_log(date('Ymd His')." : Campaign UP time \n", 3, $logPath);	
        if($req=='he')
		{
          header("Location:ZainIQHE_lp.php?lastid=$lastid");	 
	      exit;
		}			
	      header("Location:ZainIQ_lp.php?lastid=$lastid");	 
	  exit;
	}else{
         error_log(date('Ymd His')." : Campaign DOWN time \n", 3, $logPath);
		 exit; 
	}		
     }
    else
	{
		error_log(date('ymdHisu')." cap is OVER  : \n", 3, $logPath);
		echo "{\"response\":\"Cap is Over\"}";
        //header("Location:https://www.google.com/");	 
	    exit; 
    }
	}
	else if($_GET['sid']=='qavoda')
    {	 
     $Query="insert into tbl_wapidentify_qavoda_playme (referid,entrydate,pubid,subid,campid) values ('$referID',now(),'$pubid','$subid','$campid')";
	error_log(date('Ymd His')." : Query=$Query \n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {
			error_log("Error description:".date('Ymd His')." : ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
          $lastid = mysqli_insert_id($con1);		  
         error_log(date('Ymd His')."redirected to lp page: \n", 3, $logPath);
          		
	      header("Location:qavoda_lp.php?lastid=$lastid");	 
	  exit;     
    }
	else if($_GET['sid']=='iqkorek')
    {	 
     $Query="insert into tbl_wapidentify_iqkorek (referid,entrydate,pubid,subid,campid) values ('$referID',now(),'$pubid','$subid','$campid')";
	error_log(date('Ymd His')." : Query=$Query \n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {
			error_log("Error description:".date('Ymd His')." : ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
          $lastid = mysqli_insert_id($con1);		  
         error_log(date('Ymd His')."redirected to lp page: \n", 3, $logPath);
		 
		 if($_GET['req']=='he')
		 {
			 header("Location:iqkorek_he1.php?lastid=$lastid");
			die;			 
		 }else
		 {
			header("Location:iqkorek_lp.php?lastid=$lastid");
			die;
		}
	  
	  exit;     
    }else if($_GET['sid']=='pormeo')
    {	 
     $Query="insert into tbl_wapidentify_pormeo (referid,entrydate,pubid,subid,campid) values ('$referID',now(),'$pubid','$subid','$campid')";
	error_log(date('Ymd His')." : Query=$Query \n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {
			error_log("Error description:".date('Ymd His')." : ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
          $lastid = mysqli_insert_id($con1);		  
         error_log(date('Ymd His')."redirected to lp page: \n", 3, $logPath);
		 
		 if($_GET['req']=='he')
		 {
			 //header("Location:lppormeo.php?lastid=$lastid");
			 header("Location:pingen_pormeo.php?lastid=$lastid&mcc=268&mnc=06");
			die;			 
		 }else
		 {
			header("Location:lppormeo1.php?lastid=$lastid");
			die;
		}
	  
	  exit;     
    }	
else 
{
$sid= $_GET['sid'];
$req= $_GET['req'];

$Query="insert into tbl_wapidentify_poland (referid,entrydate,pubid,subid,campid,serviceid) values ('$referID',now(),'$pubid','$subid','$campid','$sid')";
	error_log(date('Ymd His')." : Query=$Query \n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {
			error_log("Error description:".date('Ymd His')." : ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
$lastid = mysqli_insert_id($con1);

if($req=="cg")
{
error_log(date('Ymd His')."redirected to cg page: \n", 3, $logPath);
header("Location:https://epayment.teleaudio.pl/api2/enyo/direct/start/DCECB31A-E979-4FA2-84F2-85CE0F7FC842?id=$lastid&redirectUrl=http://www.esports.playme.in.net/thankyou.php?st=@status%26c=@code%26lastid=$lastid");
//echo "offer is paused";
die;
}	
if($req=="cgnew")
{
error_log(date('Ymd His')."redirected to cg page: \n", 3, $logPath);
header("Location:landing_page/pl_new.php?lastid=$lastid");
die;
}

error_log(date('Ymd His')."redirected to lp page: \n", 3, $logPath);
header("Location:landing_page/pl.php?lastid=$lastid");
//echo "offer is paused";
die;
}		
?>