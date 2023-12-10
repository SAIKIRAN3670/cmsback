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

if (isset($_POST["Firstname"])) {
    $Firstname = $_POST["Firstname"];
    $Middlename = $_POST["Middlename"];
    $Lastname = $_POST["Lastname"];
    $s_gender = $_POST["s_gender"];
    $DOB = $_POST["DOB"];
    $email = $_POST["email"];
    $mobileno = $_POST["mobileno"];
    $Address1 = $_POST["Address1"];
    $Address2 = $_POST["Address2"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $pincode = $_POST["pincode"];
    $schoolname = $_POST["schoolname"];
    $s_class = $_POST["s_class"];
    $Dateofj = $_POST["Dateofj"];
    $divison = $_POST["divison"];
    $TID = $_POST["TID"];
    $Qual = $_POST["Qual"];
    $board = $_POST["board"];
    $inst = $_POST["inst"];
    $marks = $_POST["marks"];
    $exp = $_POST["exp"];
    $org = $_POST["org"];
    $sub = $_POST["sub"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpass = $_POST["cpass"];
    $sql = "insert into teacher (FirstName,MiddleName,LastName,Gender,DOB,Email,Mobile_no,Address1,Address2,State,City,Pin_Code,School_name,S_Class,Dateofjoining,Division,Teacher_id,Qualification,Board,Institution,Marks,Experience,Organization,ExpertinSubject,Username,Password,Confirm_Password)
values ('$Firstname', '$Middlename', '$Lastname','$s_gender','$DOB','$email','$mobileno','$Address1','$Address2','$state','$city','$pincode','$schoolname','$s_class','$Dateofj','$divison','$TID','$Qual','$board','$inst','$marks','$exp','$org','$sub','$username','$password','$cpass')";

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
