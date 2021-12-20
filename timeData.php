<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        //$this->open('/home/pi/db/capheat.db');
        $this->open('db/capheat.db');
    }
}

$db = new MyDB();

$data = array();
$result = $db -> query('select * from main.time');

while ($val = $result->fetchArray()) {

   array_push($data, $val);

}

$index =  count($data);

$timestamp = 0;

$startTime = 0;

$endTime = 0;

$user = "";

// find the first time block that is in the future   needs improvement 30-Dec-2017 Ulrich Roedder //
for ($x = 0; $x < $index; $x++) {
	
	if ($data[$x][3] > time()) {
  
      $timestamp = $data[$x][0];
      $user = $data[$x][1];
      $startTime = $data[$x][2];
      $endTime = $data[$x][3];
	  break;
  }
}
// if there is no match then set start and endtime to "not in range" //
if  ($startTime > 1514657167 ) {
$startTime = date('j M Y, G:i ', $startTime);
$endTime   = date('j M Y, G:i ', $endTime);
} else {$startTime = "not in range";
		$endTime = "not in range";
		$user = " nobody";
		}
echo json_encode(array("timestamp" => $timestamp, "user" => $user, "startTime" => $startTime, "endTime" => $endTime));

?>
