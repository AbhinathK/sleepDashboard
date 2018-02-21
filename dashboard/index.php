
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <title>Dashboard</title>

    <script type="text/javascript">
      tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
      tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

      function GetClock(){
      var d=new Date();
      var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getFullYear();
      var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

      if(nhour==0){ap=" AM";nhour=12;}
      else if(nhour<12){ap=" AM";}
      else if(nhour==12){ap=" PM";}
      else if(nhour>12){ap=" PM";nhour-=12;}

      if(nmin<=9) nmin="0"+nmin;
      if(nsec<=9) nsec="0"+nsec;

      document.getElementById('datebox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+"";
      document.getElementById('clockbox').innerHTML= ""  + nhour+":"+nmin+":"+nsec+ap+"";
      }

      window.onload=function(){
      GetClock();
      setInterval(GetClock,1000);
      }
      </script>

    <style>


    .sideMenu{
      background-color: purple;
    }

    .headerSection{
    }

    .clockdate{
      float:right;
      padding-right:15px;
    }

    .clock{
      font-family: "verdana";
      font-size: 40px;
      font-weight:normal;
    }

    .date{
      font-family: "verdana";
      font-size: 17px;
      font-weight:normal;
      float: right;
    }


    .dashboard{
      padding-top: 100px;
    }




    </style>



</head>

<body>

  <!-- Sidebar-->
<div class="sideMenu" style="width:25%">
  <a href="" class="simple-text">Sleep Dashboard</a>
  <a href="#" class="button">Link 1</a>
  <a href="#" class="button">Link 2</a>
  <a href="#" class="button">Link 3</a>
  <a href = "logout.php">Sign out</a>
</div>

<!-- Page Content -->
<div style="margin-left:25%">

<div class="headerSection">
  <div class="clockdate">
    <div class ="clock">
      <div id="clockbox"></div>
    </div>
    <div class = "date">
      <div id="datebox"></div>
    </div>
  </div>
</div>


<div class="dashboard">
  <?php

  $page = $_SERVER['PHP_SELF'];
  $sec = "1";
  header("Refresh: $sec; url=$page");

  require "razorflow_php/razorflow.php";
  class SampleDashboard extends StandaloneDashboard {
    protected $pdo;
    public function initialize(){
        $this->pdo = new PDO("mysql:host=localhost:3306;dbname=sleep_studies", "root", "abhikumar1971");
    }
    private function ecgChartDraw() {
        $query = $this->pdo->query("SELECT time, ecg FROM( SELECT time, ecg FROM study ORDER BY time DESC LIMIT 50 )sub ORDER BY time ASC");
        return  $query->fetchAll(PDO::FETCH_ASSOC);
    }

    private function heartRateChartDraw() {
        $query = $this->pdo->query("SELECT heart_rate FROM study ORDER BY time DESC LIMIT 1");
        return  $query->fetchAll(PDO::FETCH_ASSOC);
    }

    private function postureChartDraw() {
        $query = $this->pdo->query("SELECT posture FROM study ORDER BY time DESC LIMIT 1");
        return  $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buildDashboard () {

      $ecg = new ChartComponent('elctrocardiogram');
      $ecg->setDimensions (8, 3);
      $ecg->setCaption("ECG");

      $ecg->setYAxis("Voltage (mV)");
      // $ecg->setXAxis("Time (s)");
      $ecgValues = $this->ecgChartDraw();
      // $ecg->setLabels(ArrayUtils::pluck($ecgValues, "time"));
      $ecg->setLabels(ArrayUtils::pluck($ecgValues, "time"));
      $ecg->addSeries('ecg',"ECG",(ArrayUtils::pluck($ecgValues, "ecg")), array(
          'seriesDisplayType'=> "line",
          "seriesColor" => "#ff0000"
      ));
      $ecg->setOption('showLegendFlag', false);

      $heartRate = new KPIComponent ('heartRate');
      $heartRate->setDimensions (3, 3);
      $heartRate->setCaption ("Heart Rate");
      $heartRateValues = $this->heartRateChartDraw();
      $heartRate->setValue ((ArrayUtils::pluck($heartRateValues, "heart_rate")), array(
        'numberSuffix' => ' bpm',
        "valueTextColor" => "#00d4ff"
      ));

      $posture = new KPIComponent ('posture');
      $posture->setDimensions (3, 3);
      $posture->setCaption ("Posture");
      $postureValues = $this->postureChartDraw();
      $postureText = ArrayUtils::pluck($postureValues, "posture");
      $posture->setValue ('', array(
        'numberSuffix' => $postureText[0],
        "valueTextColor" => "#00d4ff"
      ));

        $this->addComponent($ecg);
        $this->addComponent ($heartRate);
        $this->addComponent ($posture);

    }


  }
  $dashb = new SampleDashboard();
  $dashb->setStaticRoot ("razorflow_php/static/rf/");
  $dashb->enableDevTools ();
  $dashb->renderStandalone();
  ?>
</div>

</div>


</body>


</html>
