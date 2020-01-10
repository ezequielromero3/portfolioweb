<?php

include_once("config.php");
include_once("entidades/cliente_entidades.php");
include_once("entidades/localidad.entidad.php");
include_once("entidades/provincia.entidad.php");

$cliente = new Cliente();
if($_POST){
    $cliente->cargarDesdeFormulario($_REQUEST);
    if(isset($_POST["btnInsertar"])){
        $cliente->insertar();
    } else if(isset($_POST["btnBorrar"])){
        $cliente->borrar();
    } else if(isset($_POST["btnActualizar"])){
        $cliente->actualizar();
    }
}
$aClientes = $cliente->obtenerTodos();

$provincia = new Provincia();
$aProvincias = $provincia->obtenerTodos();


if(isset($_GET["pos"])){
    $idcliente = $_GET["pos"];
    $cliente->obtenerPorID($idcliente);
}

if($_GET){
    if(isset($_GET["do"]) && $_GET["do"] == "buscarLocalidad"){
        $idProvincia = $_GET["id"];
        $localidad = new Localidad();
        $aLocalidad = $localidad->obtenerPorProvincia($idProvincia);
        echo json_encode($aLocalidad);
        exit;
    }

}


include_once("inicio.php"); 
?>

<div class="container my-5 py-2">
    <div class="row">
        <div class="col-12 text-center my-3 py-2">
            <h1>Registro de clientes</h1>
        </div>
    </div>
    <div class="row">
    <div class="col-6">
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 form group">
            <label for="txtDni">CUIT: </label>
            <br><input type="txt" name="txtCuit" id="txtCuit" class="form-control" value="<?php echo $cliente->cuit ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                <label for="txtNombre">Nombre y Apellido:</label>
                <br><input type="text" name="txtNombre" id="txtNombre"class="form-control"  value="<?php echo $cliente->nombre ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                <label for="txtTel">Telefono:</label>
                <br><input type="tel" name="txtTelefono" id="txtTelefono" class="form-control" placeholder="00-0000-0000" value="<?php echo $cliente->telefono ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form group">
                <label for="txtEmail">Correo:</label>
                <input type="correo" name="txtCorreo" id="txtCorreo" class="form-control" value="<?php echo $cliente->correo ?>">
            </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Domicilio
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cargar datos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                                        <label for="lstProvincia">Provincia:</label>
                                    <select class="form-control" name="lstProvincia" id="lstProvincia" onchange="fBuscarLocalidad();">
                                <option disabled selected>Seleccionar</option>
                                <?php $aProvincias = $provincia->obtenerTodos();
                                foreach($aProvincias as $provincia){
                                    echo "<option value='$provincia->idprovincia'>$provincia->nombre</option>";}
                                    ?>
                            </select>
                                            <label for="lstLocalidades">Localidad:</label>
                                <select class="form-control" name="lstLocalidades" id="lstLocalidades">
                            <option disabled selected>Seleccionar</option>
                        </select>
                               <label for="txtDireccion">Dirección:</label>
                               <br><input type="text" class="form-control" name="txtDireccion" id="txtDireccion">
                               <label for="lstTipoDomicilio">Tipo de Domicilio:</label>
                                <br><select class="form-control" name="lstTipoDomicilio" id="lstTipoDomicilio">
                                <option disabled selected>Seleccionar</option>
                                <option value="1">Laboral</option>
                                <option value="2">Particular</option>
                                <option value="3">Comercial</option>
                                </select>                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-primary" onclick="fAgregarDomicilio();">Agregar Domicilio</button>
                    </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
    <div class="row">
        <div class="col-12 form-group">
        <button class="btn btn-primary" type="submit" name="btnInsertar" id="btnInsertar">Insertar</button>
        <a href="clientes.php" class="btn btn-secondary">Limpiar</a>
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
    <td>Id Cliente:</td>
    <td>Nombre:</td>
    <td>CUIT:</td>
    <td>Telefono:</td>
    <td>Correo:</td></tr>
    </thead> 
    <tbody>
  <?php foreach($aClientes as $cliente) : ?>
      
        <tr>
            <td><a href="clientes.php?pos= <?php echo $cliente->idcliente; ?> "><?php echo $cliente->idcliente; ?></a></td>
            <td><?php echo $cliente->nombre ?></td>
            <td><?php echo $cliente->cuit ?></td>
            <td><?php echo $cliente->telefono ?></td>
            <td><?php echo $cliente->correo ?></td>
        </tr>
      
    <?php endforeach; ?>  
    </tbody>
    </table>
    </div>
</div>
    </div>
</div>
    </div>
</form>
                <div class="row">
                        <div class="col-12">
                        <div class="card mb-3">
                                <div class="card-header">
                                    <i class="fa fa-table"></i> Domicilios
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-secondary fa fa-plus-circle float-right" data-toggle="modal" data-target="#exampleModal"></button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table id="grilla" class="display" style="width:98%">
                                        <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Provincia</th>
                                                <th>Localidad</th>
                                                <th>Dirección</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
        <script>
                    $('#grilla').DataTable();
                                function fBuscarLocalidad(){
                    idProvincia = $("#lstProvincia option:selected").val();
                    $.ajax({
                        type: "GET",
                        url: "clientes.php?do=buscarLocalidad",
                        data: { id:idProvincia },
                        async: true,
                        dataType: "json",
                        success: function (respuesta) {
                            $("#lstLocalidades option").remove();
                    $("<option>", {
                        value: 0,
                        text: "Seleccionar",
                        disabled: true,
                        selected: true
                        }).appendTo("#lstLocalidades");
                
                    for (i = 0; i < respuesta.length; i++) {
                        $("<option>", {
                            value: respuesta[i]["idlocalidad"],
                            text: respuesta[i]["nombre"]
                            }).appendTo("#lstLocalidades");
                        }
                    $("#lstLocalidades").prop("selectedIndex", "0");
           }
       });
        }

                    function fAgregarDomicilio(){
                        var grilla = $('#grilla').DataTable();
            grilla.row.add([
                $("#lstTipoDomicilio option:selected").text() + "<input type='text' name='txtTipo[]' value='"+ $("#lstTipoDomicilio option:selected").val() +"'>",
                $("#lstProvincia option:selected").text() + "<input type='text' name='txtProvincia[]' value='"+ $("#lstProvincia option:selected").val() +"'>" ,
                $("#lstLocalidades option:selected").text() + "<input type='text' name='txtLocalidades[]' value='"+ $("#lstLocalidades option:selected").val() +"'>",
                $("#txtDireccion").val() + "<input type='text' name='txtDomicilio[]' value='"+ $("#txtDireccion").val() +"'>",
                ""
            ]).draw();
                        $('#exampleModal').modal('toggle');
                 fLimpiarFormulario();
                 }
                
                function fLimpiarFormulario(){
                    $("#lstTipoDomicilio").val(0),
                $("#lstProvincia").val(0),
                $("#lstLocalidades").val(0),
                $("#txtDireccion").val("")
                }
            </script>
                    </body>
</html>