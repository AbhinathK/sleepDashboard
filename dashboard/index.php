<?php
require "config.php"
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-6.jpg">


            <div class="sidebar-wrapper" >
                <div class="logo">
                    <a href="" class="simple-text">
                        Sleep Dashboard
                    </a>
                </div>
                <ul class="nav">
                  <div class = "patient icon">
                    <?php
                      $sql = "SELECT studyID, ecg, posture, heart_rate FROM studyID";
                      $result = mysqli_query($db $sql);
                      if ($result->num_rows > 0) {
                      echo "<table><tr><th>studyID</th><th>ecg</th></tr>";
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                          echo "<tr><td>".$row["studyID"]."</td><td>".$row["ecg"]." ".$row["posture"]."</td></tr>";
                      }
                      echo "</table>";
                  } else {
                      echo "0 results";
                  }
                  $db->close();
                    ?>

                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
              <?php

              require "razorflow_php/razorflow.php";

              class MyDashboard extends StandaloneDashboard {
                public function buildDashboard(){
                  $ecg = new ChartComponent('elctrocardiogram');
                  $ecg->setDimensions (8, 3);
                  $ecg->setCaption("ECG");
                  $ecg->setLabels (array("1", "2", "3", "4"));
                  $ecg->addSeries('sales', "Sales", array(13122, 41312, 46132, 51135), array(
                      'numberPrefix' => "$",
                      'seriesDisplayType'=> "line"
                  ));

                  $heartRate = new KPIComponent ('heartRate');
                  $heartRate->setDimensions (3, 3);
                  $heartRate->setCaption ("Heart Rate");
                  $heartRate->setValue (75, array(
                    'numberSuffix' => ' bpm',
                    "valueTextColor" => "#00d4ff"
                  ));

                  $posture = new GaugeComponent('posture');
                  $posture->setDimensions(3, 3);
                  $posture->setCaption('Posture');
                  $posture->setValue(8);
                  $posture->setLimits(0, 10);


                  $this->addComponent ($ecg);
                  $this->addComponent ($heartRate);
                  $this->addComponent($posture);




                }
              }

              // Create an instance of the dashboard that you created
              $dashb = new MyDashboard();

              // Here, we're manually setting the static root to where the CSS and HTML is available.
              // This is relative to the current path of index.php and will not work in more advanced
              // scenarios like integrating into MVC and embedding.
              $dashb->setStaticRoot ("razorflow_php/static/rf/");
              $dashb->enableDevTools ();
              $dashb->renderStandalone();
              ?>

            </div>
    </div>

</body>


</html>
