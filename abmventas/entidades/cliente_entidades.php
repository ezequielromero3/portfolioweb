<?php
include_once("config.php");
    class Cliente{
        private $idcliente;
        private $nombre;
        private $cuit;
        private $telefono;
        private $correo;
        public function __construct(){
            
        }
  
        public function __get($atributo){
        return $this->$atributo;
    }
        public function __set($atributo, $valor){
        $this->$atributo = $valor;
        return $this;
    }
    public function cargarDesdeFormulario($form){
        $this->idcliente = isset($form["pos"])?$form["pos"]:"";
        $this->nombre = $form["txtNombre"];
        $this->cuit = $form["txtCuit"];
        $this->telefono = $form["txtTelefono"];
        $this->correo = $form["txtCorreo"];
    }

    public function obtenerTodos(){
        $aClientes = array();
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "SELECT idcliente, nombre, cuit, telefono, correo
                FROM clientes ORDER BY idcliente DESC;";
        $resultado = $obj-> query($sql);
       while ($fila = $resultado->fetch_assoc()){
        $cliente = new Cliente();
        $cliente->idcliente = $fila["idcliente"];
        $cliente->nombre = $fila["nombre"];
        $cliente->cuit = $fila["cuit"];
        $cliente->telefono = $fila["telefono"];
        $cliente->correo = $fila["correo"];
        $aClientes[] = $cliente;
       
       }
       return $aClientes;
    }
    public function obtenerPorID($idcliente){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "SELECT idcliente, nombre, cuit, telefono, correo
                FROM clientes
                WHERE idcliente = $idcliente ;";
        $resultado = $obj-> query($sql);
        $fila = $resultado->fetch_assoc();
            
            $this->idcliente = $fila["idcliente"];
            $this->nombre = $fila["nombre"];
            $this->cuit = $fila["cuit"];
            $this->telefono = $fila["telefono"];
            $this->correo = $fila["correo"];
            return true;
           
           
        }
    public function insertar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "INSERT INTO clientes(nombre, cuit, telefono, correo) VALUES('$this->nombre', '$this->cuit', '$this->telefono', '$this->correo');";
        $obj-> query($sql);
        $this->idcliente = $obj->insert_id;
         }
     public function actualizar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "UPDATE clientes
        SET nombre='$this->nombre', cuit='$this->cuit', telefono='$this->telefono', correo='$this->correo' 
        WHERE idcliente = $this->idcliente ;";
      $obj-> query($sql);
        }
    public function borrar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "DELETE FROM clientes WHERE idcliente = $this->idcliente ";
        $obj-> query($sql);
        }
    }
?>