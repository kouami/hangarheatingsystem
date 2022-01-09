<?php
session_start();
include 'profile.php';


class MyDB2 extends SQLite3
{
    function __construct($profile)
    {
        if ($profile == "PROD") {
            $this->open('/home/pi/db/capheat.db');
        } else {
            $this->open('db/capheat.db'); //For testing purpose
        }
    }
}


class DataProcessor
{

    var $db;
    private $data;
    private $result;

    function __construct(){}

    function temperatureAndHumidityDataArray($profile)
    {
        $db = new MyDB2($profile);
        $data = array();
        $result = $db->query('SELECT * FROM temperatur LIMIT 240 OFFSET (SELECT COUNT(*) FROM temperatur)-240');

        while ($vale = $result->fetchArray()) {
            array_push($data, $vale);
        }

        $index = count($data);
        $downstairsData = "[";
        $upstairsData = "[";

        $fanData = 0;
        $heatData = 0;
        $eheatData = 0;

        for ($x = 0; $x < $index; $x++) {
            $downstairsData .= "[" . $x . "," . $data[$x][1] . "," . $data[$x][3] . "," . $this->unixTimeStampConverter($data[$x][0], $data[$x][1], $data[$x][3]) . "],";
            $upstairsData .= "[" . $x . "," . $data[$x][2] . "," . $data[$x][4] . "," . $this->unixTimeStampConverter($data[$x][0], $data[$x][2], $data[$x][4]) . "],";


            if ($x === ($index - 1)) {
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


        $data = array('downstairsData' => $downstairsData, 'upstairsData' => $upstairsData, 'fanData' => $fanData, 'heatData' => $heatData, "eheatData" => $eheatData, "timeData" => $this->timeDataArray($profile), "futureEvents" => $this->getUpcoming5Events($profile), "isUserLoggedIn" => $this->isUserLoggedIn());
        $data = json_encode($data);
        return $data;


    }

    /**
     * @return mixed
     */
    public function isUserLoggedIn() {
        return $_SESSION['logged_in']; // will return 1 if user is logged in.
    }

    function timeDataArray($profile) {

        //date_default_timezone_set("America/Chicago");

        $myfile = NULL;
        $myfile = fopen("error2.log", "w") or die("file not open");

        $db = new MyDB2($profile);

        $data = [];
        $result = $db -> query('select * from time');

        while ($val = $result->fetchArray()) {
            $data[] = $val;
        }

        $index =  count($data);
        $timestamp = 0;
        $startTime = 0;
        $endTime = 0;
        $user = "";

        fwrite($myfile, "\n");
        fwrite($myfile, "The value is index :" + $index);

        // find the first time block that is in the future   needs improvement 30-Dec-2017 Ulrich Roedder //
        for ($x = 0; $x < $index; $x++) {

            fwrite($myfile, "\n");
            fwrite($myfile, "The value is end: " . $data[$x][3]);

            fwrite($myfile, "Time ::: " . time());
            if ($data[$x][3] > time()) {

                //fwrite($myfile, " In loop ");
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
        } else {
            $startTime = "not in range";
            $endTime = "not in range";
            $user = " nobody";
        }

        return array("timestamp" => $timestamp, "user" => $user, "startTime" => $startTime, "endTime" => $endTime);
    }

    function unixTimeStampConverter($time, $temperature, $humidity) {
        $date = '"' . date("d F Y H:i:s", $time)  . "\\r\\nTemperature = " . round($temperature, 3) . "\\r\\nHumidity = " . round($humidity, 3) . '"';
        return $date;
    }


    function getUpcoming5Events($profile) {
        $db = new MyDB2($profile);
        $data = [];
        //$current_date_time = time();
        $date=date_create();
        $current_date_time = date_timestamp_get($date);

        $result = $db->query("SELECT * FROM time WHERE time.start > $current_date_time ORDER BY start ASC LIMIT 5 OFFSET 1");
        while ($vale = $result->fetchArray()) {

            $data[] = $vale;
        }

        $index =  count($data);

        $newData = [];
        for ($x = 0; $x < $index; $x++) {
            $newData[$x][0] = $data[$x][0];
            $newData[$x][1] = $data[$x][1];
            $newData[$x][2] = date("d F Y H:i:s", $data[$x][2]);
            $newData[$x][3] = date("d F Y H:i:s", $data[$x][3]);
        }

        return $newData;
    }
}



$dataProcessor = new DataProcessor($profile);
$data = $dataProcessor -> temperatureAndHumidityDataArray($profile);
echo $data;

