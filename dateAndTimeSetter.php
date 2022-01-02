<?php
session_start();
include 'profile.php';


//$myfile = fopen("/home/pi/html/error.log", "w") or die("file not open");

$db_handle = NULL;
$myfile = NULL;

if ($profile == "PROD") {
    $db_handle = new SQLite3('/home/pi/db/capheat.db') or die ("Cannot open the DB");
    $myfile = fopen("/home/pi/html/error.log", "w") or die("file not open");

} else {
    $db_handle = new SQLite3('db/capheat.db') or die ("Cannot open the DB");
    $myfile = fopen("error.log", "w") or die("file not open");

}

// if(!$db_handle) die ("Cannot open the DB");

$startDateTimeStr = $_POST['start'];
$endDateTimeStr = $_POST['end'];
$fanValue = $_POST['fan'];
$deleteStr = $_POST['delete'];

$startTimestamp = strtotime($startDateTimeStr);
$endTimestamp = strtotime($endDateTimeStr);
$username = $_SESSION["username"];
$currentTimestamp = strtotime('now');
$deleteValue = strtotime($deleteStr);

$fanTranslatedValue = 0;

if ($fanValue === "on") {
    $fanTranslatedValue = 1;
}

$newline = "\n";
fwrite($myfile, "$newline");

fwrite($myfile, $startTimestamp);
fwrite($myfile, "$newline");
fwrite($myfile, $endTimestamp);
fwrite($myfile, "$newline");
fwrite($myfile, $username);
fwrite($myfile, "$newline");
fwrite($myfile, $currentTimestamp);
fwrite($myfile, "$newline");
fwrite($myfile, $fanTranslatedValue);

fwrite($myfile, "$newline");

fwrite($myfile, "The value is $deleteStr");
fwrite($myfile, "$newline");
fwrite($myfile, "The value is $deleteValue");

$ok1 = NULL;

if(isset($_POST['delete'])) {
    $ok1 = $db_handle->query("DELETE FROM time WHERE timestamp=$deleteStr");
} else {
    if(($startTimestamp >= $currentTimestamp) &&  ($startTimestamp <= $endTimestamp)) {
        $ok1 = $db_handle->exec("INSERT INTO time VALUES ($currentTimestamp,'$username',$startTimestamp,$endTimestamp,$fanTranslatedValue)");
    }
}

fwrite($myfile, "Error ::: " . $db_handle->lastErrorMsg());
fwrite($myfile, "$newline");

fwrite($myfile, $ok1);

$db_handle->close();
if (!$ok1) die("Cannot Insert data");

fclose($myfile);

exit(1);

