<?php
	include('session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-6.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper" >
                <div class="logo">
                    <a href="" class="simple-text">
                        Sleep Dashboard
                    </a>
                </div>
                <ul class="nav">
                  <div class = "patient icon">

                  </div>
		  <div class = "sign out link">
		  	<a href = "logout.php">Sign Out</a>
		  </div>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
              <?php


              require "razorflow_php/razorflow.php";

              class MyDashboard extends StandaloneDashboard {
                public function buildDashboard(){

                  $chart = new ChartComponent('sales');
                  $chart->setCaption("Sales");
                  $chart->setDimensions (6, 6);
                  $chart->setLabels (array("2013", "2014", "2015"));
                  $chart->addSeries (array(3151, 1121, 4982), array(
                    'numberPrefix' => "$",
                    'seriesDisplayType' => "line"
                  ));

                 $quarterlySales = new ChartComponent('quarterlySales');
                 $quarterlySales->setDimensions (6, 6);
                 $quarterlySales->setCaption("Quarterly Sales");
                 $quarterlySales->setLabels (array("Q1", "Q2", "Q3", "Q4"));
                 $quarterlySales->addSeries(array(13122, 41312, 46132, 51135));
                 $this->addComponent ($quarterlySales);

                $numTickets = new KPIComponent ('numTickets');
                $numTickets->setDimensions (3, 3);
                $numTickets->setCaption ("Open Support Tickets");
                $numTickets->setValue (42);

                $satisfactionGauge = new GaugeComponent('satisfactionGauge');
                $satisfactionGauge->setDimensions(3, 3);
                $satisfactionGauge->setCaption('Customer Satisfaction');
                $satisfactionGauge->setValue(8);
                $satisfactionGauge->setLimits(0, 10);

                $this->addComponent($satisfactionGauge);
                $this->addComponent ($numTickets);
                $this->addComponent ($chart);
                $this->addComponent ($quarterlySales);
                }
              }

              // Create an instance of the dashboard that you created
              $db = new MyDashboard();

              // Here, we're manually setting the static root to where the CSS and HTML is available.
              // This is relative to the current path of index.php and will not work in more advanced
              // scenarios like integrating into MVC and embedding.
              $db->setStaticRoot ("razorflow_php/static/rf/");
              $db->enableDevTools ();
              $db->renderStandalone();
              ?>

            </div>
    </div>

</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>

</html>
