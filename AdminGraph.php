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

// Replace with the desired admission year
$query = "SELECT YEAR(AdmissionDate) AS admission_year, COUNT(*) AS total_users, SUM(CASE WHEN Gender='Male' THEN 1 ELSE 0 END) AS male_users, SUM(CASE WHEN Gender='Female' THEN 1 ELSE 0 END) AS female_users FROM student WHERE YEAR(AdmissionDate) IN ('2018', '2019', '2020', '2021', '2022') GROUP BY admission_year";
$result = $mysqli->query($query);

if (!$result) {
    die('Failed to retrieve data: ' . $mysqli->error);
}

// Format the results as an array
$data = array();
while ($row = $result->fetch_assoc()) {
    $admission_year = $row['admission_year'];
    $total_users = $row['total_users'];
    $male_users = $row['male_users'];
    $female_users = $row['female_users'];
    $data[] = array(
        'admission_year' => $admission_year,
        'total_users' => $total_users,
        'male_users' => $male_users,
        'female_users' => $female_users
    );
}

// Output the results as JSON
echo json_encode($data);

// Close the MySQL connection
$mysqli->close();
?>