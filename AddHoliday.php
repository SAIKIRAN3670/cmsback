<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$password = "";
$dbname = "sai-project";

$con = mysqli_connect($host, $user, $password, $dbname);

$method = $_SERVER['REQUEST_METHOD'];
if ($con) {
    echo ("connected to database");
}

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["holiday_name"])) {
    $holiday_name = $_POST["holiday_name"];
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $Description = $_POST["Description"];

    $sql = "insert into holiday (Holiday_Name,From_Date,To_date,Description	)
values ('$holiday_name', '$from_date', ' $to_date','$Description ')";

    if (mysqli_query($con, $sql)) {
        $data = array("data" => "Your Data Saved successfully");
        echo json_encode($data);
    } else {
        $data = array("data" => "Error: " . $sql . "<br>" . $con->error);
        echo json_encode($data);
    }
}
$con->close();
