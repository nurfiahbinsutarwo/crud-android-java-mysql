<?php
header("Content-Type: application/json");
include 'db.php'; 

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM costumer";
        $result = $conn->query($sql);
        $customers = $result->fetch_all(MYSQLI_ASSOC);
        $data = array(
            'status'    => true,
            'message'   => 'Data Costumer',
            'data'      =>$customers
        );
        echo json_encode($data);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $hp = $data['hp'];

        $sql = "INSERT INTO costumer (nama, alamat, hp) VALUES ('$nama', '$alamat', '$hp')";
        if ($conn->query($sql) === TRUE) {
            $data = array(
                'status'    => true,
                'message'   => 'Customer added successfully'
            );
            
        } else {
            $data = array(
                'status'    => false,
                'message'   => "Error: " . $conn->error
            );
        }
        echo json_encode($data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $hp = $data['hp'];

        $sql = "UPDATE costumer SET nama='$nama', alamat='$alamat', hp='$hp' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $data = array(
                'status'    => true,
                'message'   => 'Customer updated successfully'
            );
            
        } else {
            $data = array(
                'status'    => false,
                'message'   => "Error: " . $conn->error
            );
        }
        echo json_encode($data);
        break;

    case 'DELETE':
        // $data = json_decode(file_get_contents("php://input"), true);
        $id = $_GET['id'];
        $sql = "DELETE FROM costumer WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $data = array(
                'status'    => true,
                'message'   => 'Customer deleted successfully'
            );
            
        } else {
            $data = array(
                'status'    => false,
                'message'   => "Error: " . $conn->error
            );
        }
        echo json_encode($data);
        break;

    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

$conn->close();
?>