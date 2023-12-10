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

if ($method === 'POST' && isset($_POST["Fullname"]) && isset($_FILES["pdf"])) {
    $Fullname = $_POST["Fullname"];
    $s_gender = $_POST["s_gender"];
    $DOB = $_POST["DOB"];
    $email = $_POST["email"];
    $mobileno = $_POST["mobileno"];
    $Address = $_POST["Address"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $pincode = $_POST["pincode"];
    $s_class = $_POST["s_class"];
    $divison = $_POST["divison"];
    $Username = $_POST["Username"];
    $Level = $_POST["Level"];
    $Competition = $_POST["Competition"];
    $Certificate = $_POST["Certificate"];
    $pdf_temp = $_FILES["pdf"]["tmp_name"];
    $pdf_type = $_FILES["pdf"]["type"];
    $pdf_name = $_FILES["pdf"]["name"];

    // Generate a unique filename for the uploaded file
    // $pdf_path = 'C:\DIPLOMA SEM 5 2022-2023\project\sai project\sai-project  - Student\public\pdf' . uniqid() . '-' . $pdf_name;
    $pdf_path = 'C:\xampp\htdocs\sai_backend\co-circulam\uploads' . uniqid() . '-' . $pdf_name;


    if (is_uploaded_file($pdf_temp) && move_uploaded_file($pdf_temp, $pdf_path)) {
        $sql = "insert into cocircular (FullName,Gender,DateofBirth,Email,MobileNo,Address,State,City,Pincode,Class,Division,Username,Level,Competition,Certificate,data, type, name)
        values ('$Fullname', '$s_gender', ' $DOB','$email ','$mobileno ','$Address ','$state ','$city ','$pincode ','$s_class ','$divison ','$Username','$Level ','$Competition ','$Certificate','$pdf_path', '$pdf_type', '$pdf_name')";

        if (mysqli_query($con, $sql)) {
            $data = array("data" => "Your Data Saved successfully");
            echo json_encode($data);
        } else {
            $data = array("data" => "Error: " . $sql . "<br>" . $con->error);
            echo json_encode($data);
        }
    } else {
        $data = array("data" => "Error uploading file");
        echo json_encode($data);
    }
}
