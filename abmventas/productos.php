<?php 
 
include_once("config.php");
include_once("entidades/producto_entidades.php");
$producto = new Producto();



$aProductos = $producto->obtenerTodos();

if($_POST){
    $producto = new Producto();
    $producto->cargarDesdeFormulario($_REQUEST);
    if(isset($_POST["btnInsertar"])){
        $producto->insertar();
    } else if(isset($_POST["btnBorrar"])){
        $producto->borrar();
    } else if(isset($_POST["btnActualizar"])){
        $producto->actualizar();
    }
}

if(isset($_GET["pos"])){
    $idproducto = $_GET["pos"];
    $producto->obtenerPorID($idproducto);
}

include_once("inicio.php");

?>

<div class="container my-5 py-2">
    <div class="row">
        <div class="col-12 text-center my-3 py-2">
            <h1>Registro de productos</h1>
        </div>
    </div>
    <div class="row">
    <div class="col-6">
        <form action="" method="POST" enctype="multipart/form-data">
        
            <div class="row">
            <div class="col-12 form-group">
                <label for="txtProducto">Producto:</label>
                <br><input type="text" name="txtNombre" id="txtNombre" value="<?php echo $producto->nombre ?>" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                <label for="txtCantidad">Cantidad:</label>
                <br><input type="text" name="txtCantidad" id="txtCantidad" value="<?php echo $producto->cantidad ?>" class="form-control" >
            </div>
        </div>
        <div class="row">
            <div class="col-12 form group">
                <label for="txtImporte">Importe:</label>
                <br><input type="text" name="txtPrecio" id="txtPrecio" value="<?php echo $producto->precio?>" class="form-control" >
            </div>
        </div>
        <div class="row">
            <div class="col-12 form group">
                <label for="txtDescripcion">Descripción:</label>
                <br><textarea type="text" name="txtDescripcion" id="txtDescripcion"  class="form-control" ><?php echo $producto->descripcion ?></textarea> |
            </div>
        </div>
        <div class="row">
        <div class="col-12 form-group ">
        <button class="btn btn-primary" type="submit" name="btnInsertar" id="btnInsertar">Insertar</button>
        <a href="productos.php" class="btn btn-secondary">Limpiar</a>
        <button class="btn btn-danger" type="submit" name="btnBorrar" id="btnBorrar">Borrar</button>
        <button class="btn btn-success" type="submit" name="btnActualizar" id="btnActualizar">Actualizar</button>
    </div>
    </div>
    </div>
    <div class="col-6">
    <div class="row">
    <div class="col-12 align-center">
<table class="table table-hover">
    <thead>
    <tr>
    <td>Id Producto:      </td>
    <td>Producto:  </td>
    <td>Cantidad:   </td>
    <td>Importe:   </td>
    <td>Descripción:   </td></tr>
    </thead> 
    <tbody>
  <?php foreach($aProductos as $producto) : ?>
      
        <tr>
            <td><a href="productos.php?pos= <?php echo $producto->idproducto; ?> "><?php echo $producto->idproducto; ?></a></td>
            <td><?php echo $producto->nombre ?></td>
            <td><?php echo $producto->cantidad ?></td>
            <td><?php echo $producto->precio ?></td>
            <td><?php echo $producto->descripcion ?></td>
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