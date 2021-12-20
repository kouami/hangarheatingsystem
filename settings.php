<?php
session_start();
if($_SESSION['logged_in'] != 1) {
  header("location: index.php");
  exit();
}
?>
<html>
 <head>
<title>MN 130th Heating Setting</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>


<script type="text/javascript" src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-sliderAccess.js"></script>

<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<style>
 .action { 
    margin:10px 10px 10px 0px; 
    padding:20px 20px 20px 20px; 
    background-color:#D8D8D8 ; 
    border-radius:3px; 
    border:1px solid green;
 }

 #datetimepickerStart {
    display: inline-block;
 }
 #datetimepickerEnd {
    display: inline-block;
 }
</style>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js"></script>
  
 <script>
  $(document).ready(function(){
   $("#success").hide();
   $("#failure").hide();

   $('#start').datetimepicker({
       addSliderAccess: true,
       sliderAccessArgs: { touchonly: false }
   });
                
   $('#end').datetimepicker({
      addSliderAccess: true,
      sliderAccessArgs: { touchonly: false }
   });

   $("#settingData").submit(function(event) {
     event.preventDefault();

    if($("#start").val() != '' && $("#end").val() != ''){

    
    var formData = {
           'start' : $('input[name=start]').val(),
           'end'   : $('input[name=end]').val(),
           'fan'   : $('input[name=fanOnOff]:checked').val()
    };
   

   
    $.ajax({
      dataType: 'json',
      url: "dateAndTimeSetter.php",
      method: "POST",
      data: formData,
      dataType: 'json',
      encode: true,
      success: function(data) {
          
          $("#success").fadeTo(2000, 500).slideUp(500, function(){
          $("#success").slideUp(500);

         });
      },
      error: function() {
          $("#failure").fadeTo(2000, 500).slideUp(500, function(){
          $("#failure").slideUp(500);

        });        
      }
    });
   } else {alert("Both Fields are required...");}
  });
  });
 </script> 
   <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.11.4/themes/pepper-grinder/jquery-ui.css" />
   <link rel="stylesheet" media="all" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" />

<style>
body {
    background-color: lightblue;
}
</style>
 </head>
 <body>
<div class="container">

  <div class="jumbotron">
    <h2 class="text-primary">Heating System Configuration Page</h2>      
    <p class="text-primary">This page provides you with the nessecary interface to interact with the heating system.</p>
    <p class="text-primary"><i><strong>Welcome back,</strong></i></p> <h3><i><span id="username" class="text-success"><strong><?php echo $_SESSION["username"]; ?></strong></span></i></h3>
  </div>  

  <div class="row">
  

 <div class="col-lg-10">
    <h4 class="text-primary">Please set the Start and the End time for the Building usage</h4>
    <form id="settingData" method="POST" action="dateAndTimeSetter.php">
    <div class="col-xs-12 col-lg-12 col-md-12 action">
    <div id="datetimepickerStart" class="input-append date">
      <h5>Start Time</h5>
      <input type="text" id="start" name="start" autocomplete="off"></input>
      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
    </div>
    <div id="datetimepickerEnd" class="input-append date">
      <h5>End Time</h5>
      <input type="text" id="end" name="end" autocomplete="off"></input>
      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
    </div>
     <div>
     <input type="radio" name="fanOnOff" value="on"/> On
    </div>
    <div>
     <input type="radio" name="fanOnOff" value="off"/> Off
    </div>
    <br>
    <div>
     <input type="submit" id="submit" class="btn btn-success btn-sm" value="Submit"></input>
    </div>
    
    </div> <!-- action div end -->
    </form>
    <div id="success" class="alert alert-success">
     <button type="button" class="close" data-dismiss="alert">x</button>
     <strong>Success!</strong>
     The operation was successfull!!!
    </div>
    <div id="failure" class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert">x</button>
     <strong>Failure!</strong>
     The operation was not successfull!!!
    </div>
    
 </div> <!-- End of col-lg-10 -->
 
 </div> <!-- End of row -->

 <?php
   
 ?>

<a href="logout.php" class="btn btn-info btn-md">
  <span class="glyphicon glyphicon-log-out"></span> Log out
</a>
 </div>
 </body>
</html>