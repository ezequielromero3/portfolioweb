<?php
include_once("config.php");
    class Venta{
        private $idventa;
        private $fecha;
        private $importe;
        private $fk_idcliente;
        private $fk_idproducto;
        public function __construct(){
            
            $this->importe = 0.0;
        }
  
        public function __get($atributo){
        return $this->$atributo;
    }
        public function __set($atributo, $valor){
        $this->$atributo = $valor;
        return $this;
    }
    public function cargarDesdeFormulario($form){
        $this->idventa = isset($form["pos"])?$form["pos"]:"";
        $this->fecha = date("Y/m/d/h/m/si");
        $this->importe = $form["txtImporte"];
        $this->fk_idcliente = $form["lstCliente"];
        $this->fk_idproducto = $form["lstProducto"];
    }

     public function obtenerTodos(){
        $aVentas = array();
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "SELECT idventa, fecha, importe, fk_idcliente, clientes.nombre AS clientes_nombre, fk_idproducto, productos.nombre AS productos_nombre
                FROM ventas
                INNER JOIN clientes
                ON ventas.fk_idcliente = clientes.idcliente
                INNER JOIN productos
                ON ventas.fk_idproducto = productos.idproducto
                 ORDER BY idventa DESC;";
        $resultado = $obj-> query($sql);
       while ($fila = $resultado->fetch_assoc()){
        $venta = new Venta();
        $venta->idventa = $fila["idventa"];
        $venta->fecha = $fila["fecha"];
        $venta->importe = $fila["importe"];
        $venta->fk_idcliente = $fila["fk_idcliente"];
        $venta->fk_idproducto = $fila["fk_idproducto"];
        $venta->cliente_nombre = $fila["cliente_nombre"];
        $venta->producto_nombre = $fila["producto_nombre"];
        $aVentas[] = $venta;
       
       }
       return $aVentas;
    } 
    public function obtenerPorID($idventa){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "SELECT idventa, fecha, importe, fk_idcliente, fk_idproducto
                FROM ventas
                WHERE idventa = $idventa ;";
        $resultado = $obj-> query($sql);
        $fila = $resultado->fetch_assoc();
            
            $this->idventa = $fila["idventa"];
            $this->fecha = $fila["fecha"];
            $this->importe = $fila["importe"];
            $this->fk_idcliente = $fila["fk_idcliente"];
            $this->fk_idproducto = $fila["fk_idproducto"];
            return true;
           
           
        }

    public function insertar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "INSERT INTO ventas(fecha, importe, fk_idcliente, fk_idproducto) VALUES('$this->fecha', '$this->importe', '$this->fk_idcliente', '$this->fk_idproducto');";
        $obj-> query($sql);
        $this->idventa = $obj->insert_id;
        }
     public function actualizar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "UPDATE ventas
        SET fecha='$this->fecha', importe='$this->importe', fk_idcliente='$this->fk_idcliente', fk_idproducto='$this->fk_idproducto' 
        WHERE idventa = $this->idventa ;";
      $obj-> query($sql);
        }
    public function borrar(){
        $obj = new mysqli(Constante::DDBB_HOST, Constante::DDBB_USUARIO, Constante::DDBB_CLAVE, Constante::DDBB_DBNAME);
        $sql = "DELETE FROM ventas WHERE idventa = $this->idventa ";
        $obj-> query($sql);
        }
    }
?>