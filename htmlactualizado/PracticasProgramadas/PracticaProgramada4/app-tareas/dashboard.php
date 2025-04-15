<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container mt-4">
    <h1>Dashboard</h1>
    <a href="logout.php" class="btn btn-danger mb-3">Cerrar Sesión</a>
    
    <form id="task-form">
        <input type="hidden" id="task-id" name="task-id" value="">
        <div class="form-group">
            <label for="task-title">Título</label>
            <input type="text" class="form-control" id="task-title" name="task-title" required>
        </div>
        <div class="form-group">
            <label for="task-desc">Descripción</label>
            <textarea class="form-control" id="task-desc" name="task-desc" required></textarea>
        </div>
        <div class="form-group">
            <label for="due-date">Fecha de Vencimiento</label>
            <input type="date" class="form-control" id="due-date" name="due-date" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Tarea</button>
    </form>

    <div id="task-list" class="row mt-4"></div>
</div>

<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title" id="taskModalLabel">Editar Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modal-task-form">
            <input type="hidden" id="task-id" name="task-id" value="">
            <div class="form-group">
                <label for="task-title-modal">Título</label>
                <input type="text" class="form-control" id="task-title-modal" name="task-title" required>
            </div>
            <div class="form-group">
                <label for="task-desc-modal">Descripción</label>
                <textarea class="form-control" id="task-desc-modal" name="task-desc" required></textarea>
            </div>
            <div class="form-group">
                <label for="due-date-modal">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="due-date-modal" name="due-date" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/dashboard.js"></script>
</body>
</html>
