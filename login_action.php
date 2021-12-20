<?php 
session_start();

if(isset($_POST["username"]) && isset($_POST["password"])) {
 
 $username = $_POST["username"];
 $password = $_POST["password"];

$file = fopen('/home/pi/credentials.txt', "r");
   $credentials = array();
   
   $index = 0;
   $found = "False";
   $line_of_text = "";
   while(!feof($file)) {
     $line_of_text .= fgets($file);
   }
   
   $credentials = explode("\n", $line_of_text);

   for($index = 0; $index < count($credentials); $index ++ ) {
     $line = $credentials[$index];
     $lineArr = array();
     $lineArr = explode(":", $line);

     if($lineArr[0] === $username && $lineArr[1] === $password) {
       
       $found = "True";
       $_SESSION["username"] = $_POST["username"];
       $_SESSION["logged_in"] = 1;
       break;
     }
   }
   
   fclose($file);
   
   if($found === "True") {
     echo "YES";
   } else {
     echo "NO";
   }
} 

?>
