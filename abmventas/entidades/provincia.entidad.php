<?php

class Provincia{
    private $idprovincia;
    private $nombre;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    public function obtenerTodos(){
        $aProvincias = null;
        $mysqli = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $mysqli->set_charset("utf8");
       $resultado = $mysqli->query("SELECT 
            idprovincia,
            nombre
            FROM provincias ORDER BY nombre ASC");

        while ($fila = $resultado->fetch_assoc()) {
            $entidad = new Provincia();
            $entidad->idprovincia = $fila["idprovincia"];
            $entidad->nombre = $fila["nombre"];
            $aProvincias[] = $entidad;
        }
        return $aProvincias;
    }

}


?>