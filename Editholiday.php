<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

include 'DbConnect.php';
$objDb = new DbConnect;
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        $sql = "SELECT * FROM holiday";
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if (isset($path[3]) && is_numeric($path[3])) {
            $sql .= " WHERE H_id = :H_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':H_id', $path[3]);
            $stmt->execute();
            $users1 = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $users1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        echo json_encode($users1);
        break;
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $sql = "INSERT INTO holiday(H_id,holiday_name,from_date,to_date,Description) VALUES (null,:holiday_name, :from_date, :to_date, :Description,)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':holiday_name', $user->holiday_name);
        $stmt->bindParam(':from_date', $user->from_date);
        $stmt->bindParam(':to_date', $user->to_date);
        $stmt->bindParam(':Description', $user->Description);

        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'Record created successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to create record.'];
        }
        echo json_encode($response);
        break;

    case "PUT":
        $user = json_decode(file_get_contents('php://input'));
        $sql = "UPDATE holiday SET holiday_name= :holiday_name, from_date =:from_date, to_date =:to_date, Description =:Description WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':H_id', $user->H_id);
        $stmt->bindParam(':holiday_name', $user->holiday_name);
        $stmt->bindParam(':from_date', $user->from_date);
        $stmt->bindParam(':to_date', $user->to_date);
        $stmt->bindParam(':Description', $user->Description);


        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'Record updated successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to update record.'];
        }
        echo json_encode($response);
        break;

    case "DELETE":
        $sql = "DELETE FROM holiday WHERE H_id = :H_id";
        $path = explode('/', $_SERVER['REQUEST_URI']);

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $path[3]);

        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'Record deleted successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to delete record.'];
        }
        echo json_encode($response);
        break;
}
