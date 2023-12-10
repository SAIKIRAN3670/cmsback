<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');
// Connect to the MySQL database
$host = 'localhost';
$user = "root";
$password = "";
$dbname = "sai-project";
$mysqli = new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

// Retrieve the number of users from the database
$query = "(SELECT COUNT(*) AS num_users FROM student)
          UNION
          (SELECT COUNT(*) AS num_users FROM teacher)";
$result = $mysqli->query($query);
if (!$result) {
    die('Failed to retrieve number of users: ' . $mysqli->error);
}
$num_users = 0;
while ($row = $result->fetch_assoc()) {
    $num_users += $row['num_users'];
}
// echo 'Total number of users: ' . $num_users;

// Retrieve the number of users from the database
$query = "SELECT COUNT(*) AS num_boys FROM student WHERE Gender = 'Male'";
$result = $mysqli->query($query);
if (!$result) {
    die('Failed to retrieve number of users: ' . $mysqli->error);
}
$row = $result->fetch_assoc();
$num_boys = $row['num_boys'];


// Retrieve the number of users from the database
$query = "SELECT COUNT(*) AS num_girls FROM student WHERE Gender = 'Female'";
$result = $mysqli->query($query);
if (!$result) {
    die('Failed to retrieve number of users: ' . $mysqli->error);
}
$row = $result->fetch_assoc();
$num_girls = $row['num_girls'];

// Retrieve the number of users from the database
$query = "SELECT COUNT(*) AS num_teacher FROM teacher";
$result = $mysqli->query($query);
if (!$result) {
    die('Failed to retrieve number of users: ' . $mysqli->error);
}
$row = $result->fetch_assoc();
$num_teacher = $row['num_teacher'];

header('Content-Type: application/json');
$data = array($num_users, $num_boys, $num_girls, $num_teacher);
echo json_encode($data);

// Close the MySQL connection
$mysqli->close();
