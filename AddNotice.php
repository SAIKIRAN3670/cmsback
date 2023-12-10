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

if (isset($_POST["Title"])) {
    $Title = $_POST["Title"];
    $Message = $_POST["Message"];
    $Date = $_POST["Date"];
    $AnnouncementBy = $_POST["AnnouncementBy"];

    $sql = "insert into notice (Title,Message,Date,AnnouncementBy)
values ('$Title', '$Message', '$Date','$AnnouncementBy')";

    if (mysqli_query($con, $sql)) {
        $data = array("data" => "Your Data Saved successfully");
        echo json_encode($data);
    } else {
        $data = array("data" => "Error: " . $sql . "<br>" . $con->error);
        echo json_encode($data);
    }
}
// // run SQL statement
// $result = mysqli_query($con,$sql);

// // die if SQL statement failed
// if (!$result) {
// http_response_code(404);
// die(mysqli_error($con));
// }

// if ($method == 'POST') {
// echo json_encode($result);
// } else {
// echo mysqli_affected_rows($con);
// }
// }


$con->close();
