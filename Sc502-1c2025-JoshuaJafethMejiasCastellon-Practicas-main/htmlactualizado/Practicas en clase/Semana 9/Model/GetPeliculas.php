<?php

class GetPeliculas {

    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'peliculas_tabla');
    }

    public function getAllPelis() {
        $result = $this->db->query("SELECT * FROM peliculas_tablas");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>