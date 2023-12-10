<?php


error_reporting(0);
// make is suitable for SSE
header("Cache-Control: no-store");
header("Content-Type: text/event-stream");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');


$connect = mysqli_connect("localhost", "root", "", "sai-project");
$sql = "SELECT*FROM teacher";
$result = mysqli_query($connect, $sql);
$json_array = array();
while ($row = mysqli_fetch_assoc($result)) {
    $json_array[] = $row;
}
echo json_encode($json_array);







































// // make connection with database
// include("db_connection.php");

// // lets continue to check data in database with loop
// $p = '';

// $sql = "select * from student";
// $result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));

// //create an array
// $emparray = array();
// while ($row = mysqli_fetch_assoc($result)) {
//     $emparray[] = $row;
// }
// echo json_encode($emparray);
// now fetch data from database
// $result = $con->query("SELECT * FROM student");
// $r = array();
// if($result->num_rows > 0){
//     while($row = $result-> fetch_assoc()){
//         // get all data in json from
//         $r[] = $row;
//     }
// }
// $n = json_encode($r);
// if(strcmp($p, $n) !== 0){
//     // here data will shown on change
//     echo "data:" . $n . "\n\n";
//     $p = $n;
// }
// // here data is shown each time
// // but we need data when change
// // mean when data add, update or delete then show only

// // this will show data even the loading is not completed
// ob_end_flush();
// flush();

// sleep process for 1 sec
// sleep(1);
    // but still data will not show
