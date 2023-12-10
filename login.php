<?php
session_start();
error_reporting(0);
// make is suitable for SSE
header("Cache-Control: no-store");
header("Content-Type: text/event-stream");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');
include('db_connection.php');

session_start();
error_reporting(0);
include 'DbConnect.php';
$objDb = new DbConnect;
$conn = $objDb->connect();

if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT Username, Password FROM student WHERE Username=:UserName AND Password=:password";
    $query = $conn->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {

        echo "<script>alert('Invalid Details');</script>";
        echo "success";
    }
}
// 
?>

<!-- 
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Get the username and password from the POST request
//     $UserName = $_POST['UserName'];
//     $password  = $_POST['password'];

//     // Prepare and execute the SQL query to fetch the user with given username and password
//     $sql = "SELECT Username, Password FROM student WHERE Username=:UserName AND Password=:password LIMIT 0, 25";
//     $query = $dbh->prepare($sql);
//     $query->bindParam(':UserName', $UserName, PDO::PARAM_STR);
//     $query->bindParam(':password', $password, PDO::PARAM_STR);
//     $query->execute();

//     // Check if a user was found
//     if ($query->rowCount() > 0) {
//         // Authentication successful
//         // Set session variables or generate a JWT token
//         // Return success response
//         $data = array("data" => "login Successfully");
//         echo json_encode($data);
//     } else {
//         // Authentication failed
//         // Return error response
//         $data = array("data" => "login Failed");
//         echo json_encode($data);
//     }
// } else {
//     // Return an error response for invalid request method
//     http_response_code(400);
//     $data = array("data" => "Invalid request method");
//     echo json_encode($data);
// } -->


<!-- ?> -->