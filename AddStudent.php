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
    $admission = $_POST["admission"];
    $divison = $_POST["divison"];
    $Student_GRNO = $_POST["Student_GRNO"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpass = $_POST["cpass"];
    $sql = "insert into student (FirstName,MiddleName,LastName,Gender,DateofBirth,Email,MobileNo,Address1,Address2,State,City,Pincode,School,Class,AdmissionDate,Division,Student_GRNO,Username,Password,ConfirmPassword)
values ('$Firstname', '$Middlename', '$Lastname','$s_gender','$DOB','$email','$mobileno','$Address1','$Address2','$state','$city','$pincode','$schoolname','$s_class','$admission','$divison','$Student_GRNO','$username','$password','$cpass')";

    if (mysqli_query($con, $sql)) {
        $data = array("data" => "Your Data Saved successfully");
        echo json_encode($data);
    } else {
        $data = array("data" => "Error: " . $sql . "<br>" . $conn->error);
        echo json_encode($data);
    }
}
$con->close();
