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
$hr_=$get->hr;
list($part1,$part2)=explode(',', $hr_);
$hr = $part2;
$pos_ = $get->pos;
list($part1_, $part2_)=explode(',',$pos_);
$pos = $part2_;
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


$conn = new mysqli('localhost:3306','root','team29UCL', 'sleep_studies');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "DB Connected successfully";

//mysqli_select_db($conn,"sleep_study");

echo "\n DB is seleted as Test  successfully";

setcookie(heart_rate, 0, time() + 60, "/");
setcookie(posture, "facing up", time() + 60, "/");

//$temp_hr = 0;
//$temp_posture = "facing up";


if($type=='hr'){
    fwrite($f,"worked");
    list($part1, $part2) = explode(',', $data);
    setcookie("heart_rate", $part2, time() + 60, "/");
    fwrite($f, $_COOKIE['heart_rate']);
    //$sql="INSERT INTO hr (fValue, ftime) VALUES ('$part2', $part1)";
    fwrite($f,"\n");
    fwrite($f, $part1);
    fwrite($f,"\n");
    fwrite($f, $part2);
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    fclose($f);
    mysqli_close($conn);

}
if($type=='pos'){
        fwrite($f,"worked");
        list($part1, $part2) = explode(',', $data);
        setcookie("posture", $part2, time() + 60, "/");
	fwrite($f, $_COOKIE['posture']);
        //$sql="INSERT INTO pos (fValue, ftime) VALUES ('$part2', $part1)";
        fwrite($f,"\n");
        fwrite($f, $part1);
        fwrite($f,"\n");
        fwrite($f, $part2);
    if ($conn->query($sql) === TRUE) {
        fwrite($f,"\n");
        fwrite($f,"worked");
        echo "New record created successfully";
    } else {
        fwrite($f,"\n");
        fwrite($f,"notworked");
        fwrite($f,"\n");
        fwrite($f,$conn->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    fclose($f);
    mysqli_close($conn);

}

if($type=='ecg'){
        fwrite($f,"noworked");
	//fwrite($f, $_COOKIE['heart_rate']);
	//fwrite($f, $_COOKIE['posture']);
        $sql="INSERT INTO test (time, ecg, heart_rate, posture) VALUES ($time, $data, '$hr', '$pos')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
	fwrite($f, $conn->error);
    }
    fclose($f);
    mysqli_close($conn);

}










