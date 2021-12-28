var mainData = "";

function drawLineGraphs() {

    const options = {
        theme: 'material',
        hAxis: {
            title: 'Time'
        },
        vAxis: {
            title: 'Temp/Humidity'
        },

        smoothLine: true,
        width: 600,
        height: 240,
        backgroundColor: '#f1f8e9',
        colors: ['#a52714', '#097138'],
        min: 0,
        max: 50,
        chartArea: {left: 50, top: 30, width: "70%", height: "70%"},
        tooltip: {isHtml: true}
    };


    $.ajax({
        url: "DataProcessor.php",
        async: false,
        type: "POST",
        success: function (data, status, xhr) {

            data = $.parseJSON(data);
            mainData = data;

            <!-- Load and draw Downstairs data -->

            const downstairsData = data.downstairsData;

            const responseDataD = new google.visualization.DataTable(downstairsData);
            responseDataD.addColumn('number', 'X');
            responseDataD.addColumn('number', 'Temperature');
            responseDataD.addColumn('number', 'Humidity');
            // A column for custom tooltip content
            responseDataD.addColumn({type: 'string', role: 'tooltip'});
            responseDataD.addRows(JSON.parse(downstairsData));

            const chartD = new google.visualization.LineChart(document.getElementById('myGraph'));
            chartD.draw(responseDataD, google.charts.Line.convertOptions(options));

            <!-- Load and draw Upstairs data -->

            const upstairsData = data.upstairsData;

            const responseDataU = new google.visualization.DataTable(upstairsData);
            responseDataU.addColumn('number', 'X');
            responseDataU.addColumn('number', 'Temperature');
            responseDataU.addColumn('number', 'Humidity');
            // A column for custom tooltip content
            responseDataU.addColumn({type: 'string', role: 'tooltip'});
            responseDataU.addRows(JSON.parse(upstairsData));

            const chartU = new google.visualization.LineChart(document.getElementById('myGraph2'));
            chartU.draw(responseDataU, google.charts.Line.convertOptions(options));

            $("#startTime").html(data.timeData.startTime);
            $("#endTime").html(data.timeData.endTime);
            $("#user").html(data.timeData.user);

        },
        error: function (data) {
            //alert(data.responseText);
        }
    });

}

function display() {

    const fanData = mainData.fanData;
    const heatData = mainData.heatData;
    const eheatData = mainData.eheatData;

    if (fanData === 1) {
        //$('#fan').prop('checked', true);
        $('#fanStuff').html('<img src="images/running_fan.gif" width="90" height="90">');

    } else {
        //$('#fan').prop('checked', false);
        $('#fanStuff').html('<img src="images/not_running_fan.png" width="90" height="90">');
    }

    if (heatData === 1) {
        //$('#heat').prop('checked', true);
        $('#heatStuff').html('<img src="images/burning_flames.gif" width="90" height="90">');
    } else {
        //$('#heat').prop('checked', false);
        $('#heatStuff').html('<img src="images/heater_no_heat.png" width="90" height="90">');
    }

    if (eheatData === 1) {
        //$('#eheat').prop('checked', true);
        $('#eheatStuff').html('<img src="images/eheat_on.png" width="90" height="90">');

    } else {
        //$('#eheat').prop('checked', false);
        $('#eheatStuff').html('<img src="images/eheat_cold.png" width="90" height="90">');
    }

}


function processLogin() {
    $('#login_button').click(function () {
        const username = $('#username').val();
        const password = $('#password').val();
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

                        setTimeout('window.location.href = "settings.php";', 1000);
                    }
                }
            });
        } else {
            alert("Both Fields are required");
        }
    });
    $('#logout').click(function () {
        const action = "logout";
        $.ajax({
            url: "login_action.php",
            method: "POST",
            data: {action: action},
            success: function () {
                location.reload();
            }
        });
    });

}