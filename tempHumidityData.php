


<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/home/pi/db/capheat.db');
        //$this->open('db/capheat.db'); For testing purpose
    }
}

$db = new MyDB();

$data= array();
$result = $db->query('SELECT * FROM temperatur LIMIT 240 OFFSET (SELECT COUNT(*) FROM temperatur)-240');//
// var_dump($result->fetchArray());

while ($vale = $result->fetchArray())
{
array_push($data, $vale);

}



$index =  count($data);
// echo($index);
//echo "Downstairs Temperatur  " .$data[$index][1];
// echo "  C and ";
//echo ($data[$index][3]) ;
//echo " % Humidity <p>";
//echo "Upstairs Temperatur  " .$data[$index][2];
//echo "  C and ";
//echo ($data[$index][4]) ;
//echo " % Humidity <p>";
//if ($data[$index][5]) {echo "Heater is on ";}
//if ($data[$index][6]) {echo "Fan is on ";}

// echo "<p>Last Timestamp " . date("d/m/Y H:i:///s",$data[$index][0]) . " Record ". $index . "<br>";

$downstairsData = "[";

$upstairsData = "[";

$fanData  = 0;
$heatData = 0;
$eheatData = 0;

for ($x = 0; $x < $index; $x++) {
	$temparray[$x] = $data[$x][1];
        $downstairsData .= "[" . $x . "," . $data[$x][1] . "," . $data[$x][3] . "],"; 
        $upstairsData .="[" . $x . "," . $data[$x][2] . "," . $data[$x][4] . "],";
		
        if($x === ($index -1)) {
           $heatData = $data[$x][5];
           $fanData = $data[$x][6];
           $eheatData = $data[$x][7];
		   
        }

}

//Heater 5
//Fan 6

$downstairsData = substr($downstairsData, 0, -1);
$downstairsData = $downstairsData . "]";

$upstairsData = substr($upstairsData, 0, -1);
$upstairsData = $upstairsData . "]";


$data = array('downstairsData' => $downstairsData, 'upstairsData' => $upstairsData, 'fanData' => $fanData, 'heatData' => $heatData, "eheatData" => $eheatData);
echo json_encode($data);

?> 
