<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1>Datos enviados</h1>
<?php 
include_once 'funciones_generales.php';

if(isset($_REQUEST["txtNombre"]) && $_REQUEST["txtNombre"] !="" && isset($_REQUEST["txtEmail"]) && $_REQUEST["txtEmail"] !=""){
	//Mostrar datos normalmente
	echo "Nombre: " .$_POST["txtNombre"];
echo "<br>Email: " .$_POST["txtEmail"];
echo "<br>Telefono: " .$_POST["txtTel"];
echo "<br>Mensaje: " .$_POST["txtMensaje"];
echo errorLog(" Correo: ".$_REQUEST["txtEmail"]." Nombre: ".$_REQUEST["txtNombre"]);
} else{
	echo "Campo/s incompleto/s";
}


 ?>
</body>
</html>