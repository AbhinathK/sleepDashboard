<?php
echo "hello world";
/*
$get = json_decode(stripslashes($_POST['req']));
// Get data from object
$name = $get->name; // Get name you send
$age = $get->age; // Get age of user
echo "\n \n \n";
echo $name;
echo "\n";
echo $age;


$jsonurl = 'http://192.168.0.11:8080/test/testjson.php';
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json, JSON_PRETTY_PRINT);
echo $json_output;

$url="http://192.168.0.11:8080/test/testjson.php";
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);

$json = json_decode($result);
echo $json->name;

    ob_start();

    var_dump(json_decode(file_get_contents('php://input')));

    $out = ob_get_contents();

    ob_end_clean();

    $f = fopen('out.txt', 'w+');


    fwrite($f, html_entity_decode($out));

    fclose($f);
*/
$get = json_decode(stripslashes($_POST['req']));
$data = $get->data; // Get name you send

$time = $get->time; // Get age of user
$data_= date("m-d-Y H:i:s", $time/1000);
$type = $get ->type;
$content = stripslashes(file_get_contents("php://input"));
$f = fopen('out.txt', 'w+');

fwrite($f, $content);
fwrite($f,"\n");
fwrite($f, $time);
fwrite($f,"\n");
fwrite($f, $data);
fwrite($f,"\n");
fwrite($f, $type);
fwrite($f,"\n");
fwrite($f, $data_);
fclose($f);

require_once("config.php");

//if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
//}
//echo "DB Connected successfully";

//mysqli_select_db($conn,"sleep_study");

//echo "\n DB is seleted as Test  successfully";

$sql="INSERT INTO test (time, ecg) VALUES ($time,$data)";
//$sql="INSERT INTO  (ftime) VALUES ($time)";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}


//mysqli_close($conn);




