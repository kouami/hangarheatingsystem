<?php
session_start();
include 'profile.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    header("refresh: 360;");
    ?>
    <title>MN 130th Heating Controler</title>
    <script src="js/jquery.min-3.2.1.js"></script>
    <script src="js/gstatic-charts-loader.js"></script>
    <script src="js/popper-1.12.3.min.js"></script>
    <script src="js/bootstrap.min-4.0.0-beta.2.js"></script>

    <script src="js/bootstrap-toggle.min-2.2.2.js"></script>
    <script src="js/jquery-ui.min-1.10.2.js"></script>
    <script src="js/jQuery.switchButton.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/jquery.timepicker.min-1.3.5.js"></script>
    <script>
        var isLoggedIn = null;
        isLoggedIn = "<?php  echo $_SESSION['logged_in']; ?>";

    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/jquery.timepicker.min-1.3.5.css">
    <!--link rel="stylesheet" href="css/bootstrap.min-4.0.0-beta.2.css"-->
    <link rel="stylesheet" href="css/jQuery.switchButton.css">

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
        $(document).ready(function () {
            //$('#confirmBox').hide();
            google.charts.load('current', {packages: ['corechart', 'line']});
            google.charts.setOnLoadCallback(drawLineGraphs);
            drawLineGraphs();
            setInterval(drawLineGraphs, 360000); //redraw every 6 minutes without refreshing the page
            //setInterval(drawLineGraphs, 5000); // For debugging purpose only
            displayFutureEvents();
            display();
            processLogin();
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


<body>

<div class="container">
    <br/>
    <div class="row">

        <div class="container-fluid py-5 bg-primary rounded-3 border">
            <h3 class="display-6 fw-bold text-light">MN 130th Hangar Heater control system</h3>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6">
            <h4>Upstairs Temperature and Humidity</h4>

            <div id="myGraph2" class="border border-primary"></div>

        </div>
        <div class="md-md-6"></div>
    </div> <!-- end of first class row -->

    <div class="row">

        <div class="col-md-6">
            <h4>Downstairs Temperature and Humidity</h4>

            <div id="myGraph" class="border border-primary d-flex"></div>

        </div>
        <div class="col-md-6"></div>

    </div> <!-- end of second class row -->

    <div class="row">

        <!--div class="col-sm-24" style="width:600px"-->
        <div class="col-md-6">
            <br/>
            <!--div style="background:#f1f8e9; border:1px solid black; width:603px;"-->
            <div class="alert alert-secondary  align-items-center border border-secondary">


                <h4>
                    <b>Fan</b><span id="fanStuff"></span>
                    <b>Heat</b><span id="heatStuff"></span>
                    <b>EHeat</b><span id="eheatStuff"></span>
                </h4>


            </div>

        </div>
        <div class="col-md-6"></div>
    </div> <!-- end of second row -->


    <div class="row">

        <div class="col-md-6">


            <?php
            $myfile;
            if ($profile == "PROD") {
                $myfile = fopen("/home/pi/temp/data.txt", "r") or die("Unable to open file!");
            } else {
                $myfile = fopen("data.txt", "r") or die("Unable to open file!"); //for testing purpose
            }

            $string = fgets($myfile);
            fclose($myfile);
            $json = json_decode($string);
            $llt = $json[0] * 10;
            $llt = (int)$llt;
            $llt = $llt / 10;
            $Ult = $json[2] * 10;
            $Ult = (int)$Ult;
            $Ult = $Ult / 10;
            ?>

            <br/>
            <div class="alert alert-primary d-flex align-items-center border border-primary" role="alert">
                <div>
                    <?php print  "<h6>" . $llt . "&#176C LL Temperature " . (int)$json[1] . "%  LL Humidity " . $json[8] . "g/m&#179 Abs Humidity</h6>"; ?>
                </div>
            </div>

            <div class="alert alert-success d-flex align-items-center border border-success" role="alert">
                <div>
                    <?php print  "<h6>" . $Ult . "&#176C UL Temperature " . (int)$json[3] . "%  UL Humidity " . $json[9] . "g/m&#179 Abs Humidity</h6>"; ?>
                </div>
            </div>

            <div class="alert alert-warning d-flex align-items-center border border-warning" role="alert">
                <div>
                    <?php print  "<h6>" . $json[5] . "&#176C Outside Temperature " . $json[6] . "%  Outside Humidity " . $json[7] . "g/m&#179 Abs Humidity</h6>"; ?>
                </div>
            </div>

            <p>

            <div class="alert alert-success border border-success">
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
                <button type="button" name="login" id="login" class="btn btn-primary btn-lg border border-dark"
                        data-toggle="modal"
                        data-target="#loginModal">Login
                </button>
                <?php
                if ($_SESSION['logged_in'] == 1) {
                    echo '<button type = "button" name = "delete" data-toggle="modal"
                        data-target="#confirmBox" id = "delete" class="btn btn-secondary btn-lg border border-dark" onClick = "deleteCurrentEvent()"> Delete</button>';
                    echo ' <a href="settings.php" class="btn btn-danger btn-lg border border-dark" role="button" >Set Events</a>';
                    echo '<div><br><a href="logout.php" class="btn btn-info btn-sm border border-dark"><span class="glyphicon glyphicon-log-out"></span> Log out</a></div>';
                }
                ?>
            </div>

        </div>
        <div class="col-md-6"></div>
    </div> <!-- End of row -->
    <div class="row"> <!-- Future Events Row -->
        <div class="col-md-6">
            <div class="list-group" id="futureEvents">

                <div id="fe" class="collapse">

                </div>

            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>

    <!-- Login Modal -->

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
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
                        <br/>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                <label for="password" class="input-group-addon glyphicon glyphicon-lock"></label>
                            </div> <!-- /.input-group -->
                        </div> <!-- /.form-group -->
                        <br/>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div> <!-- /.checkbox -->
                    </form>

                </div> <!-- /.modal-body -->

                <div class="modal-footer">
                    <button id="login_button" class="form-control btn btn-primary">Ok</button>
                </div> <!-- /.modal-footer -->

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- End Login Modal -->



    <!--</div> --> <!-- end of second row -->
    <br/>
    <div class="text-light fst-normal badge bg-secondary">
        <?php
        $t = time();
        (int)$delta = $t - (int)$json[4];
        echo($delta . " Seconds since last measurment    ");
        echo(date("d-F-Y   G:i", $t));
        $tj = date("G", $t);
        ?>
    </div>
    <br/>
    <br/>
</div> <!-- class container -->
<!-- Current event modal deletion -->
<div class="modal fade" id="confirmBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Confirm Deletion</p>
            </div>
            <!--Body-->
            <div class="modal-body">
                <p>Are you sure you want to delete this current event?</p>
            </div>
            <!--Footer-->
            <div class="modal-footer flex-center">
                <a href="" class="btn  btn-outline-success" id="btnYes">Yes</a>
                <a type="button" class="btn  btn-success waves-effect" data-dismiss="modal" id="btnNo">No</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<div class="modal fade" id="confirmBoxCurrent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Event Deletion Confirmation</p>
            </div>
            <!--Body-->
            <div class="modal-body">
                <p>Are you sure you want to delete this event?</p>
            </div>
            <!--Footer-->
            <div class="modal-footer flex-center">
                <a href="" class="btn  btn-outline-success" id="btnY">Yes</a>
                <a type="button" class="btn  btn-success waves-effect" data-dismiss="modal" id="btnN">No</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
</body>
</html>

