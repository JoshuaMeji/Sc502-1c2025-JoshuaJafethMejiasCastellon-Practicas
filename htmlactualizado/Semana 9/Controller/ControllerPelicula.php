<?php
require_once 'Model/GetPeliculas.php';

class PeliculaController {

    public function listarArticulos() {
        $PeliModel = new GetPeliculas();
        $Pelicula = $PeliModel->getAllPelis();
        require_once 'views/articulos/list.php';
    }
}
?>
    