<?php 
session_start();

//try {
	
$myfile = fopen("/home/pi/html/error.log", "w") or die("file not open");
$db_handle = new SQLite3('/home/pi/db/capheat.db') or die ("Cannot open the DB");
// if(!$db_handle) die ("Cannot open the DB");

$startDateTimeStr = $_POST['start'];
$endDateTimeStr = $_POST['end'];
$fanValue = $_POST['fan'];

$startTimestamp = strtotime($startDateTimeStr);
$endTimestamp = strtotime($endDateTimeStr);
$username = $_SESSION["username"];
$currentTimestamp = strtotime('now');

$fanTranslatedValue = 0;
if($fanValue === "on") {
$fanTranslatedValue = 1;
} 
$newline = "\n";
fwrite($myfile,"$newline");

fwrite($myfile, $startTimestamp);
fwrite($myfile,"$newline");
fwrite($myfile, $endTimestamp);
fwrite($myfile,"$newline");
fwrite($myfile, $username );
fwrite($myfile,"$newline");
fwrite($myfile, $currentTimestamp);
fwrite($myfile,"$newline");
fwrite($myfile ,$fanTranslatedValue);

fwrite($myfile,"$newline");

$ok1 = $db_handle->exec("INSERT INTO time VALUES ($currentTimestamp,'$username',$startTimestamp,$endTimestamp,$fanTranslatedValue)");

fwrite( $myfile,"Error ::: " . $db_handle->lastErrorMsg());
fwrite($myfile,"$newline");

fwrite($myfile, $ok1);

$db_handle->close();
if(!$ok1) die("Cannot Insert data");

//$startTimeReverse = date('Y-m-d h:i:s',$startTimestamp);//new DateTime('$startTimestamp');
//$endTimeReverse = date('Y-m-d h:i:s',$endTimestamp);//new DateTime('$endTimestamp');

//$myArr = array("start" => $startDateTimeStr, "end" => $endDateTimeStr, 
//         "startTimestamp" => $startTimestamp, "endTimestamp" => $endTimestamp,
//         "startTimeReverse" => $startTimeReverse, "endTimeReverse" => $endTimeReverse);
//echo json_encode($myArr);



//catch(Exception $e){
//fwrite($myfile,$e->getMessage());
fclose($myfile);
//echo $e->getMessage();

//}

exit(1);
?>
