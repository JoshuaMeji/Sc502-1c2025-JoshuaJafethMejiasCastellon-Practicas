<?php

session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit();
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email y contraseña son requeridos']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email no es válido']);
    exit();
}

require_once 'db.php';

$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()){
    http_response_code(409);
    echo json_encode(['success' => false, 'message' => 'El email ya está registrado']);
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
if ($stmt->execute([$email, $hashedPassword])) {
    echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario']);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container mt-4">
    <h1>Registrarse</h1>
    <form id="register-form">
        <div id="register-error"></div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required >
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required >
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirmar Contraseña:</label>
            <input type="password" id="confirm-password" name="confirm-password" class="form-control" required >
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    <p class="mt-3">¿Ya tienes una cuenta? <a href="index.php">Inicia Sesión</a></p>
</div>

<script src="js/register.js"></script>
</body>
</html>
