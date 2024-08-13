<?php
session_start();
error_reporting(0);
$logPath = "log/dlrnotification".date("Ymd").".txt";
error_log(date('Ymd His')." :  requested url:".$_SERVER['REQUEST_URI']."\n", 3, $logPath);
error_log(date('Ymd His')." :  requested url:".$_SERVER['QUERY_STRING']."\n", 3, $logPath);
error_log(date('Ymd His').": before curl\n", 3, $logPath);
///////////////////
 //url of php to be called

$url = "http://139.59.3.239/game24/notification_curl.php?".$_SERVER['QUERY_STRING'];

$test = curl_init();

  //this will set the minimum time to wait before proceed to the next line to 100 milliseconds

curl_setopt_array($test,[CURLOPT_URL=>$url,CURLOPT_TIMEOUT_MS=>100,CURLOPT_RETURNTRANSFER=>TRUE]);

curl_exec($test);

  //this line will be executed after 100 milliseconds

curl_close ($test); 
///////////////////
error_log(date('Ymd His').": after curl\n", 3, $logPath);
echo "OK";
exit;
?>