<?php
session_start();
include 'profile.php';


$db_handle = NULL;
$myfile = NULL;

if ($profile == "PROD") {
    $db_handle = new SQLite3('/home/pi/db/capheat.db') or die ("Cannot open the DB");
    $myfile = fopen("/home/pi/html/error.log", "w") or die("file not open");

} else {
    $db_handle = new SQLite3('db/capheat.db') or die ("Cannot open the DB");
    $myfile = fopen("error.log", "w") or die("file not open");

}

$timestamp = $_POST['timestamp'];

$sql = "DELETE FROM time WHERE timestamp=$timestamp";

$result = $db_handle->query($sql);

$db_handle->close();
if (!$result) die("Cannot delete data");

fclose($myfile);

exit(1);