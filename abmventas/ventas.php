
<?php
 
include_once("config.php");
include_once("entidades/venta_entidades.php");
$venta = new Venta();

$aVentas = $venta->obtenerTodos();

if($_POST){
    $venta = new Venta();
    $venta->cargarDesdeFormulario($_REQUEST);
    if(isset($_POST["btnInsertar"])){
        $venta->insertar();
    } else if(isset($_POST["btnBorrar"])){
        $venta->borrar();
    } else if(isset($_POST["btnActualizar"])){
        $venta->actualizar();
    }
}

if(isset($_GET["pos"])){
    $idventa = $_GET["pos"];
    $venta->obtenerPorID($idventa);
}

include_once("inicio.php");
include_once("entidades/cliente_entidades.php");
include_once("entidades/producto_entidades.php");
?>
<div class="container my-5 py-2">
    <div class="row">
        <div class="col-12 text-center my-3 py-2">
            <h1>Registro de ventas</h1>
        </div>
    </div>
    <div class="row">
    <div class="col-6">
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 form group">
            <label for="txtFecha">Fecha: </label>
            <br><input type="text" name="txtFecha" id="txtFecha" class="form-control" value="<?php echo $venta->fecha ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                <label for="txtImporte">Importe:</label>
                <br><input type="text" name="txtImporte" id="txtImporte" class="form-control" value="<?php echo $venta->importe ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form group">
            <label for="lstCliente">Cliente:</label>
             	<select class="form-control" name="lstCliente" id="lstCliente" required="">
               <option disabled selected>Seleccionar</option>
               <?php $cliente = new Cliente();
               $aClientes = $cliente->obtenerTodos();
               foreach($aClientes as $cliente){
                   if($venta->fk_idcliente==$cliente->idcliente){
                   echo "<option selected value='.$cliente->idcliente.'>'.$cliente->idcliente.':'.$cliente->nombre.'</option>";}
                else {
                    echo "<option value='.$cliente->idcliente.'>'.$cliente->idcliente.': '.$cliente->nombre.'</option>" ;} 
               }
                ?>
        </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 form group my-3">
                <label for="lstProducto">Producto:</label>
	                <select class="form-control" name="lstProducto" id="lstProducto" required="">
	                <option disabled selected>Seleccionar</option>
                    <?php $producto = new Producto();
               $aProductos = $producto->obtenerTodos();
               foreach($aProductos as $prodcuto){
                   if($venta->fk_idproducto==$producto->idproducto){
                   echo "<option selected value='.$producto->idproducto.'>'.$producto->idproducto.':'.$producto->nombre.'</option>";}
                else {
                    echo "<option value='.$producto->idproducto.'>'.$producto->idproducto.': '.$producto->nombre.'</option>" ;} 
               }
                ?>
                </select>
            </div>
        </div>
        <div class="row">
        <div class="col-12 form-group ">
        <button class="btn btn-primary" type="submit" name="btnInsertar" id="btnInsertar">Insertar</button>
        <a href="ventas.php" class="btn btn-secondary">Limpiar</a>
        <button class="btn btn-danger" type="submit" name="btnBorrar" id="btnBorrar">Borrar</button>
        <button class="btn btn-success" type="submit" name="btnActualizar" id="btnActualizar">Actualizar</button>
    </div>
    </div>
    <div class="col-6">
    <div class="row">
    <div class="col-12 align-center">
<table class="table table-hover">
    <thead>
    <tr>
    <td>Id Venta:</td>
    <td>Fecha:</td>
    <td>Importe:</td>
    <td>Id Cliente:</td>
    <td>Id Producto:</td></tr>
    </thead> 
    <tbody>
  <?php foreach($aVentas as $venta) : ?>
      
        <tr>
            <td><a href="ventas.php?pos= <?php echo $venta->idventa; ?> "><?php echo $venta->idventa; ?></a></td>
            <td><?php echo $venta->fecha ?></td>
            <td><?php echo $venta->importe ?></td>
            <td><?php echo $venta->fk_idcliente ?></td>
            <td><?php echo $venta->fk_idproducto ?></td>
        </tr>
      
    <?php endforeach; ?>  
    </tbody>
    </table>
    </div>
</div>
    </div>
</div>
</form>
    
</body>
</html>