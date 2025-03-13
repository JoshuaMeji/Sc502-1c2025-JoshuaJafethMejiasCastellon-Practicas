<?php
require_once 'config/config.php';
require_once 'Controllers/ControllerPelicula.php';

$action = $_GET['action'] ?? 'login';

        $controller = new PeliculaController();
        $controller->listarPelis();
?>