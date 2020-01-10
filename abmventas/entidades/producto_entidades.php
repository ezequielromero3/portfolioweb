<?php
include_once("config.php");
    class Producto{
        private $idproducto;
        private $nombre;
        private $cantidad;
        private $precio;
        private $descripcion;
        public function __construct(){
            $this->cantidad = 0;
            $this->precio = 0.0;
        }
  
        public function __get($atributo){
        return $this->$atributo;
    }
        public function __set($atributo, $valor){
        $this->$atributo = $valor;
        return $this;
    }
    public function obtenerTodos(){
        $aProductos = array();
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "SELECT idproducto, nombre, cantidad, precio, descripcion
                FROM productos ORDER BY idproducto DESC;";
        $resultado = $obj-> query($sql);
       while ($fila = $resultado->fetch_assoc()){
        $producto = new Producto();
        $producto->idproducto = $fila["idproducto"];
        $producto->nombre = $fila["nombre"];
        $producto->cantidad = $fila["cantidad"];
        $producto->precio= $fila["precio"];
        $producto->descripcion = $fila["descripcion"];
        $aProductos[] = $producto;
       
       }
       return $aProductos;
    }
    public function obtenerPorID($idproducto){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "SELECT idproducto, nombre, cantidad, precio, descripcion
                FROM productos
                WHERE idproducto = $idproducto ;";
        $resultado = $obj-> query($sql);
        $fila = $resultado->fetch_assoc();
            
            $this->idproducto = $fila["idproducto"];
            $this->nombre = $fila["nombre"];
            $this->cantidad = $fila["cantidad"];
            $this->precio= $fila["precio"];
            $this->descripcion = $fila["descripcion"];
            return true;
           
           
        }
    public function cargarDesdeFormulario($form){
        $this->idproducto = isset($form["pos"])?$form["pos"]:"";
        $this->nombre = $form["txtNombre"];
        $this->cantidad = $form["txtCantidad"];
        $this->precio = $form["txtPrecio"];
        $this->descripcion = $form["txtDescripcion"];
    }
    public function insertar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "INSERT INTO productos(nombre, cantidad, precio, descripcion) VALUES('$this->nombre', '$this->cantidad', '$this->precio', '$this->descripcion');";
        $obj-> query($sql);
        $this->idproducto = $obj->insert_id;
         }
     public function actualizar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "UPDATE productos
         SET nombre='$this->nombre', cantidad='$this->cantidad', precio='$this->precio', descripcion='$this->descripcion' 
         WHERE idproducto = $this->idproducto ;";
        $obj-> query($sql);
    
         }
    public function borrar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "DELETE FROM productos WHERE idproducto = $this->idproducto ";
        $obj-> query($sql);
        
         }
    }
    
?>