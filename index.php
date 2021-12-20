<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <?php
    header("refresh: 360;");
    ?>
    <title>MN 130th Heating Controler</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--script src="http://www.google.com/jsapi"></script -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script src="js/jQuery.switchButton.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/jQuery.switchButton.css">
    <style>
        .switch-wrapper {
            display: inline-block;
            position: relative;
            top: 3px;
            font-size: 18px;

        }
    </style>
    <style>
        .modal-header-primary {
            color: #fff;
            padding: 9px 15px;
            border-bottom: 1px solid #eee;
            background-color: #428bca;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .modal-footer-primary {
            color: #fff;
            padding: 9px 15px;
            border-bottom: 1px solid #eee;
            background-color: #428bca;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">


        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawLineColorsD);

        function drawLineColorsD() {

            $.ajax({
                url: "tempHumidityData.php",
                //dataType: "json",
                async: false,
                type: "GET",
                //contentType: "application/json; charset=utf-8",
                success: function (data, status, xhr) {

                    data = $.parseJSON(data);

                    var downstairsData = data.downstairsData;

                    //$("#testdisplay").html(data);


                    const responseData = new google.visualization.DataTable(downstairsData);
                    responseData.addColumn('number', 'X');
                    responseData.addColumn('number', 'Temperature');
                    responseData.addColumn('number', 'Humidity');
                    //responseData.addRows([[0,4.4000000953674,1],[1,4.3000001907349,1],[2,4.3000001907349,1],[3,4.3000001907349,1],[4,4.1999998092651,1],[5,4.1999998092651,1],[6,4.1999998092651,1],[7,4.0999999046326,1],[8,4.0999999046326,1],[9,4.0999999046326,1],[10,3.9000000953674,1],[11,3.9000000953674,1],[12,3.9000000953674,1],[13,3.9000000953674,1],[14,3.7999999523163,1],[15,3.7999999523163,1],[16,3.7999999523163,1],[17,3.7999999523163,1],[18,3.7999999523163,1],[19,3.7999999523163,1],[20,3.7000000476837,1],[21,3.7000000476837,1],[22,3.7000000476837,1],[23,3.7000000476837,1],[24,3.5999999046326,1],[25,3.5999999046326,1],[26,3.5,1],[27,3.5,1],[28,3.5,1],[29,3.5,1],[30,3.5,1],[31,3.5,1],[32,3.4000000953674,1],[33,3.4000000953674,1],[34,3.4000000953674,1],[35,3.2999999523163,1],[36,3.4000000953674,1],[37,3.4000000953674,1],[38,3.2999999523163,1],[39,3.4000000953674,1],[40,3.2999999523163,1],[41,3.2999999523163,1],[42,3.2999999523163,1],[43,3.2999999523163,1],[44,3.2999999523163,1],[45,3.2999999523163,1],[46,3.2000000476837,1],[47,3.2000000476837,1],[48,3.2000000476837,1],[49,3.2000000476837,1],[50,3.2000000476837,1],[51,3.2000000476837,1],[52,3.0999999046326,1],[53,3.0999999046326,1],[54,3.0999999046326,1],[55,3.0999999046326,1],[56,3.0999999046326,1],[57,3.0999999046326,1],[58,3,1],[59,3,1],[60,3,1],[61,2.9000000953674,1],[62,3,1],[63,2.9000000953674,1],[64,3.4000000953674,1],[65,3.5999999046326,1],[66,3.9000000953674,1],[67,4.0999999046326,1],[68,4,1],[69,3.7000000476837,1],[70,3.7000000476837,1],[71,3.5,1],[72,3.5,1],[73,3.5,1],[74,3.4000000953674,1],[75,3.2999999523163,1],[76,3.2999999523163,1],[77,3.2999999523163,1],[78,3.2999999523163,1],[79,3.2000000476837,1],[80,3.2000000476837,1],[81,3.0999999046326,1],[82,3.0999999046326,1],[83,3.0999999046326,1],[84,3.0999999046326,1],[85,3,1],[86,3,1],[87,3,1],[88,3,1],[89,3,1],[90,3,1],[91,2.9000000953674,1],[92,3,1],[93,2.9000000953674,1],[94,3.4000000953674,1],[95,3.5999999046326,1],[96,3.9000000953674,1],[97,4,1],[98,3.9000000953674,1],[99,3.7000000476837,1],[100,3.5999999046326,1],[101,3.5,1],[102,3.4000000953674,1],[103,3.2999999523163,1],[104,3.2000000476837,1],[105,3.2000000476837,1],[106,3.2000000476837,1],[107,3.2000000476837,1],[108,3.0999999046326,1],[109,3.0999999046326,1],[110,3,1],[111,3,1],[112,3,1],[113,2.9000000953674,1],[114,2.9000000953674,1],[115,3,1],[116,3.2999999523163,1],[117,3.7999999523163,1],[118,4.0999999046326,1],[119,3.9000000953674,1],[120,3.7999999523163,1],[121,3.5,1],[122,3.5,1],[123,3.4000000953674,1],[124,3.2999999523163,1],[125,3.2000000476837,1],[126,3.2999999523163,1],[127,3.2000000476837,1],[128,3.2999999523163,1],[129,3.2000000476837,1],[130,3.2000000476837,1],[131,3.2999999523163,1],[132,3.2999999523163,1],[133,3.2999999523163,1],[134,3.2999999523163,1],[135,3.2999999523163,1],[136,3.2999999523163,1],[137,3.2999999523163,1],[138,3.2000000476837,1],[139,3.2000000476837,1],[140,3.0999999046326,1],[141,3,1],[142,3.0999999046326,1],[143,3,1],[144,3,1],[145,3,1],[146,3,1],[147,3,1],[148,3,1],[149,2.9000000953674,1],[150,2.9000000953674,1],[151,2.9000000953674,1],[152,3.5999999046326,1],[153,3.5999999046326,1],[154,4.5999999046326,1],[155,4.0999999046326,1],[156,4.0999999046326,1],[157,3.7999999523163,1],[158,3.7000000476837,1],[159,3.5999999046326,1],[160,3.5999999046326,1],[161,3.5999999046326,1],[162,3.5,1],[163,3.5,1],[164,3.4000000953674,1],[165,3.4000000953674,1],[166,3.4000000953674,1],[167,3.2999999523163,1],[168,3.2999999523163,1],[169,3.0999999046326,1],[170,3.0999999046326,1],[171,3.0999999046326,1],[172,3.0999999046326,1],[173,3.0999999046326,1],[174,3,1],[175,3,1],[176,3,1],[177,3,1],[178,3,1],[179,2.9000000953674,1],[180,2.7999999523163,1],[181,3.0999999046326,1],[182,3.0999999046326,1],[183,3.5,1],[184,3.7000000476837,1],[185,3.4000000953674,1],[186,3.2000000476837,1],[187,3,1],[188,2.9000000953674,1],[189,2.7999999523163,1],[190,2.9000000953674,1],[191,3.2999999523163,1],[192,3.9000000953674,1],[193,4.4000000953674,1],[194,4.5,1],[195,3.9000000953674,1],[196,3.9000000953674,1],[197,3.7000000476837,1],[198,3.5,1],[199,3.2999999523163,1],[200,3.0999999046326,1],[201,3,1],[202,3,1],[203,3,1],[204,2.9000000953674,1],[205,3,1],[206,3,1],[207,3.4000000953674,1],[208,3.5999999046326,1],[209,3.2999999523163,1],[210,3.2000000476837,1],[211,3.0999999046326,1],[212,3.0999999046326,1],[213,3.2000000476837,1],[214,3.2000000476837,1],[215,3.0999999046326,1],[216,3.0999999046326,1],[217,3.0999999046326,1],[218,3.0999999046326,1],[219,3.0999999046326,1],[220,3.0999999046326,1],[221,3.0999999046326,1],[222,3.2000000476837,1],[223,3.0999999046326,1],[224,3.0999999046326,1],[225,3.0999999046326,1],[226,3.0999999046326,1],[227,3.0999999046326,1],[228,3,1],[229,3,1],[230,3,1],[231,3,1],[232,3,1],[233,3,1],[234,2.9000000953674,1],[235,2.9000000953674,1],[236,3,1],[237,3.7000000476837,1],[238,3.7999999523163,1],[239,4.0999999046326,1]]);
                    //console.log(downstairsData);
                    //responseData.addRows(downstairsData);
                    responseData.addRows(JSON.parse(downstairsData));

                    var options = {
                        hAxis: {
                            title: 'Time'
                        },
                        vAxis: {
                            title: 'Temp/Humidity'
                        },
                        min: 0,
                        max: 50,
                        smoothLine: true,
                        width: 600,
                        height: 240,
                        backgroundColor: '#f1f8e9',
                        colors: ['#a52714', '#097138'],
                        chartArea: {left: 50, top: 30, width: "70%", height: "70%"}
                    };


                    var chart = new google.visualization.LineChart(document.getElementById('myGraph'));
                    //chart.draw(data, {width: 400, height: 240});
                    chart.draw(responseData, options)
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });

        }
    </script>

    <script type="text/javascript">


        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawLineColorsU);

        function drawLineColorsU() {

            $.ajax({
                type: "POST",
                url: "tempHumidityData.php",
                //dataType: "json",
                contentType: "application/json; charset=utf-8",
                async: false,
                success: function (data) {

                    data = $.parseJSON(data);

                    var upstairsData = data.upstairsData;

                    //$("#testdisplay").html(data);

                    var responseData = new google.visualization.DataTable(upstairsData);
                    responseData.addColumn('number', 'X');
                    responseData.addColumn('number', 'Temperature');
                    responseData.addColumn('number', 'Humidity');
                    responseData.addRows(JSON.parse(upstairsData));

                    var options = {
                        hAxis: {
                            title: 'Time'
                        },
                        vAxis: {
                            title: 'Temp/Humidity'
                        },
                        min: 0,
                        max: 50,
                        smoothLine: true,
                        width: 600,
                        height: 240,
                        backgroundColor: '#f1f8e9',
                        colors: ['#a52714', '#097138'],
                        chartArea: {left: 50, top: 30, width: "70%", height: "70%"}
                    };


                    var chart = new google.visualization.LineChart(document.getElementById('myGraph2'));

                    chart.draw(responseData, options);
                },
                error: function (response) {
                    //var err = eval("(" + response.responseText + ")");
                    //alert(response.responseText);
                }
            });

        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            drawLineColorsU();
            drawLineColorsD();
            setInterval(drawLineColorsU, 360000); //redraw every 6 minutes without refreshing the page
            setInterval(drawLineColorsD, 360000); //redraw every 6 minutes without refreshing the page
        });
    </script>
    <script type="text/javascript">

        $(document).ready(
            function setFanAndHeat() {

                $.ajax({
                    url: "tempHumidityData.php",
                    //dataType: "json",
                    async: false,
                    success: function (response) {
                        //alert("this is ajax");
                        var fanData = response.fanData;
                        var heatData = response.heatData;
                        var eheatData = response.eheatData;

                        if (fanData === 1) {

                            //$('#fan').prop('checked', true);
                            $('#fanStuff').append('<img src="images/running_fan.gif" width="90" height="90">');

                        } else {

                            //$('#fan').prop('checked', false);
                            $('#fanStuff').append('<img src="images/not_running_fan.png" width="90" height="90">');

                        }

                        if (heatData === 1) {

                            //$('#heat').prop('checked', true);
                            $('#heatStuff').append('<img src="images/burning_flames.gif" width="90" height="90">');

                        } else {

                            //$('#heat').prop('checked', false);
                            $('#heatStuff').append('<img src="images/heater_no_heat.png" width="90" height="90">');

                        }

                        if (eheatData === 1) {

                            //$('#eheat').prop('checked', true);
                            $('#eheatStuff').append('<img src="images/eheat_on.png" width="90" height="90">');

                        } else {

                            //$('#eheat').prop('checked', false);
                            $('#eheatStuff').append('<img src="images/eheat_cold.png" width="90" height="90">');

                        }

                        //$('#fan').attr('disabled', true);
                        //$('#heat').attr('disabled', true);
                        //$('#eheat').attr('disabled', true);
                    }
                });
            });
    </script>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: "timeData.php",
                dataType: "json",
                async: false,
                success: function (data) {

                    $("#startTime").html(data.startTime);
                    $("#endTime").html(data.endTime);
                    $("#user").html(data.user);

                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#login_button').click(function () {
                var username = $('#username').val();
                var password = $('#password').val();
                if (username != '' && password != '') {
                    $.ajax({
                        url: "login_action.php",
                        method: "POST",
                        data: {username: username, password: password},
                        success: function (data) {

                            if (data === "NO") {
                                alert("Invalid Credentials");
                            } else {
                                $('#loginModal').hide();
                                //location.reload();
                                setTimeout('window.location.href = "settings.php";', 1000);
                            }
                        }
                    });
                } else {
                    alert("Both Fields are required");
                }
            });
            $('#logout').click(function () {
                var action = "logout";
                $.ajax({
                    url: "login_action.php",
                    method: "POST",
                    data: {action: action},
                    success: function () {
                        location.reload();
                    }
                });
            });
        });
    </script>

    <script>
        $(function () {
            $(".switch-wrapper input").switchButton({
                width: 100,
                height: 40,
                button_width: 50
            });

            $("#slider-1.demo input").switchButton({
                width: 100,
                height: 40,
                button_width: 50
            });
        })

    </script>

</head>
<style>
    body {
        background-color: lightblue;
    }


    body, h1, h2, h3, h4, h5, h6 {
        font-family: "Raleway", Arial, Helvetica, sans-serif
    }

    .mySlides {
        display: none
    }
</style>
<style>
    @media (min-width: 768px) {
        .container-small {
            width: 300px;
        }

        .container-large {
            width: 970px;
        }
    }

    @media (min-width: 992px) {
        .container-small {
            width: 500px;
        }

        .container-large {
            width: 1170px;
        }
    }

    @media (min-width: 1200px) {
        .container-small {
            width: 700px;
        }

        .container-large {
            width: 1500px;
        }
    }

    .container-small, .container-large {
        max-width: 100%;
    }

</style>

<body>

<div class="jumbotron text-center">
    <h5 class="display-4">MN 130th Hangar Heater control system</h5>

    <hr class="my-4">
</div>

<div class="container">
    <div class="row">

        <div class="col-sm-12">
            <h3>Upstairs Temperature and Humidity</h3>

            <div id="myGraph2"></div>

        </div>
    </div> <!-- end of first class row -->

    <div class="row">

        <div class="col-sm-12">
            <h3>Downstairs Temperature and Humidity</h3>

            <div id="testdisplay"></div>
            <div id="myGraph"></div>

        </div>


    </div> <!-- end of second class row -->

    <div class="row">

        <div class=" col">

            <div style="background:#f1f8e9; width:600px;">


                <h4>
                    <b><i>Fan</i></b><span id="fanStuff"></span>
                    <b><i>Heat</i></b><span id="heatStuff"></span>
                    <b><i>EHeat</i></b><span id="eheatStuff"></span>
                </h4>

                <!--<h4><b><i>Heat</i></b><span id="heatStuff"></span></h4> -->


            </div>

        </div>
    </div> <!-- end of second row -->


    <div class="row">

        <div class="col-sm-12">


            <?php

            //$myfile = fopen("/home/pi/temp/data.txt", "r") or die("Unable to open file!");
            $myfile = fopen("data.txt", "r") or die("Unable to open file!");

            $string = fgets($myfile);
            fclose($myfile);
            $json = json_decode($string);
            $llt = $json[0] * 10;
            $llt = (int)$llt;
            $llt = $llt / 10;
            $Ult = $json[2] * 10;
            $Ult = (int)$Ult;
            $Ult = $Ult / 10;
            print  "<h4>" . $llt . "&#176C LL Temperatur " . (int)$json[1] . "%  LL Humidity " . $json[8] . "g/m&#179 Abs Humidity</h4>";
            print  "<h4>" . $Ult . "&#176C UL Temperatur " . (int)$json[3] . "%  UL Humidity " . $json[9] . "g/m&#179 Abs Humidity</h4>";
            print  "<h4>" . $json[5] . "&#176C Outside Temperatur " . $json[6] . "%  Outside Humidity " . $json[7] . "g/m&#179 Abs Humidity</h4>";
            ?>

            <?php
            $t = time();
            (int)$delta = $t - (int)$json[4];
            echo($delta . " Seconds since last measurment    ");
            echo(date("d-F-Y   G:i", $t));
            $tj = date("G", $t);

            ?>

            <p>

            <div class="alert alert-success" style="width:600px">
                <h5>

                    <div>
                        <strong>Start Time:</strong> <span id="startTime" class="label label-primary"></span>
                    </div>
                    <div>
                        <strong>End Time:</strong> <span id="endTime" class="label label-primary"></span>
                    </div>
                    <div>
                        <strong>Requested by:</strong> <span id="user" class="label label-primary"><b></b></span>
                    </div>
                </h5>
                <button type="button" name="login" id="login" class="btn btn-primary btn-lg" data-toggle="modal"
                        data-target="#loginModal">Login
                </button>
            </div>

            <!--<button type="button" name="login" id="login" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal">Login</button>-->

        </div>
    </div> <!-- End of row -->

    <!-- Login Modal -->

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Log in</h4>
                </div> <!-- /.modal-header -->

                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" placeholder="Username">
                                <label for="username" class="input-group-addon glyphicon glyphicon-user"></label>
                            </div>
                        </div> <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                <label for="password" class="input-group-addon glyphicon glyphicon-lock"></label>
                            </div> <!-- /.input-group -->
                        </div> <!-- /.form-group -->

                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div> <!-- /.checkbox -->
                    </form>

                </div> <!-- /.modal-body -->

                <div class="modal-footer">
                    <button id="login_button" class="form-control btn btn-primary">Ok</button>

                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1"
                             aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
                            <span class="sr-only">progress</span>
                        </div>
                    </div>
                </div> <!-- /.modal-footer -->

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- End Login Modal -->

    <!--</div> --> <!-- end of second row -->

</div> <!-- class container -->


</body>
</html>

