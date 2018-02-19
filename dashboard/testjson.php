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

require_once("config.php");

$content = file_get_contents("php://input");
$f = fopen('out.txt', 'w+');


fclose($f);

$get = json_decode(stripslashes($_POST['req']));

$time = $get->time;
$data = $get->data;

$sql="INSERT INTO studyID (time, ecg) VALUES($time,$data)";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
