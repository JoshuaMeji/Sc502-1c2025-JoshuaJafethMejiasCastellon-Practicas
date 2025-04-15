<?php

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit();
}

require_once 'db.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

switch ($accion) {
    case 'agregarComentario':
        $taskId = isset($_POST['task_id']) ? intval($_POST['task_id']) : 0;
        $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

        if (!$taskId || empty($comentario)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO comentarios (task_id, user_id, comentario) VALUES (?, ?, ?)");
        if ($stmt->execute([$taskId, $_SESSION['user_id'], $comentario])) {
            echo json_encode(['success' => true, 'message' => 'Comentario agregado']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al agregar comentario']);
        }
        break;

    case 'listarComentarios':
        $taskId = isset($_GET['task_id']) ? intval($_GET['task_id']) : 0;
        if (!$taskId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID de tarea inválido']);
            exit();
        }

        $stmt = $pdo->prepare("SELECT id, comentario FROM comentarios WHERE task_id = ?");
        $stmt->execute([$taskId]);
        $comentarios = $stmt->fetchAll();
        echo json_encode(['success' => true, 'comentarios' => $comentarios]);
        break;

    case 'editarComentario':
        $comentarioId = isset($_POST['comentario_id']) ? intval($_POST['comentario_id']) : 0;
        $nuevoComentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

        if (!$comentarioId || empty($nuevoComentario)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            exit();
        }
        
        $stmt = $pdo->prepare("UPDATE comentarios SET comentario = ? WHERE id = ? AND user_id = ?");
        if ($stmt->execute([$nuevoComentario, $comentarioId, $_SESSION['user_id']])) {
            echo json_encode(['success' => true, 'message' => 'Comentario actualizado']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al actualizar comentario']);
        }
        break;

    case 'eliminarComentario':
        $comentarioId = isset($_POST['comentario_id']) ? intval($_POST['comentario_id']) : 0;
        if (!$comentarioId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID de comentario inválido']);
            exit();
        }

        $stmt = $pdo->prepare("DELETE FROM comentarios WHERE id = ? AND user_id = ?");
        if ($stmt->execute([$comentarioId, $_SESSION['user_id']])) {
            echo json_encode(['success' => true, 'message' => 'Comentario eliminado']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al eliminar comentario']);
        }
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Acción no reconocida']);
        break;
}
?>
