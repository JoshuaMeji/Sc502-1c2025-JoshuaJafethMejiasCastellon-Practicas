<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "wishlist_db"); 

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Conexión fallida"]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query = "SELECT * FROM wishes ORDER BY fecha DESC";
    $wishes[];
    while $row = $result->fetch_assoc(){
        $wishes [] = $row
    }
    echo json_encode($wishes);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if(!isset($data["decripcion"]) || empty($data["descipcion"])){
        http_response_code(400);
        echo json_encode(["error" => "descripcion no recibida"]);
        exit;
    }
    $descripcion = $conn->real_escape_string()
        $conn->prepare("INSERT INTO wishes (descripcion) VALUES (?)");
        echo json_encode(["message" => "Deseo Agregado"]);
        exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data); // Leemos los datos del DELETE
    
    if (!isset($data["id"])) { 
        http_response_code(400);
        echo json_encode(["error" => "ID no recibida"]);
        exit;
    }
    
    $id = $conn->real_escape_string($data["id"]); 
    $result = $conn->query("DELETE FROM wishes WHERE id = $id"); 
    
    if ($result) {
        echo json_encode(["message" => "Deseo eliminado con éxito"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Error al eliminar el deseo"]);
    }
    exit;
}

$conn->close();
?>
