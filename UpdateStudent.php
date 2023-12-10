<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$host = "localhost";
$user = "root";
$password = "";
$dbname = "sai-project";
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

// $method = $_SERVER['REQUEST_METHOD'];
// if ($conn) {
//     echo ("connected to database");
// }

// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

if (isset($_POST["Firstname"])) {
    $id = $_POST['id'];
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

    try {
        $query = "UPDATE student SET FirstName=:Firstname, MiddleName=:Middlename,LastName=:Lastname,Gender=:s_gender,DateofBirth=:DOB,Email=:email,MobileNo=:mobileno,Address1=:Address1,Address2=:Address2,State=:state,City=:city,Pincode=:pincode,School=:schoolname,Class=:s_class,AdmissionDate=:admission,Division=:divison,Student_GRNO=:Student_GRNO,Username=:username,Password=:password,ConfirmPassword=:cpass WHERE id =:id";
        $statement = $conn->prepare($query);

        $statement->bindParam(':FirstName', $Firstname);
        $statement->bindParam(':Middlename', $Middlename);
        $statement->bindParam(':Lastname', $Lastname);
        $statement->bindParam(':Gender', $s_gender);
        $statement->bindParam(':DateofBirth',  $DOB);
        $statement->bindParam(':Email', $email);
        $statement->bindParam(':MobileNo', $mobileno);
        $statement->bindParam(':Address1', $Address1);
        $statement->bindParam(':Address2', $Address2);
        $statement->bindParam(':State', $state);
        $statement->bindParam(':City', $city);
        $statement->bindParam(':Pincode', $pincode);
        $statement->bindParam(':School', $schoolname);
        $statement->bindParam(':Class', $s_class);
        $statement->bindParam(':AdmissionDate', $admission);
        $statement->bindParam(':Division', $divison);
        $statement->bindParam(':Student_GRNO', $Student_GRNO);
        $statement->bindParam(':Username', $username);
        $statement->bindParam(':Password', $password);
        $statement->bindParam(':ConfirmPassword', $cpass);
        $statement->bindParam(':id', $id);
        echo ($id);

                    $query_execute = $statement->execute();

        if ($query_execute) {
            http_response_code(200);
            echo json_encode(array("message" => "Record was updated."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update record."));
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
