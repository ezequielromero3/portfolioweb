<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<?php

function errorLog($variable){
	$fecha_actual = date("Y-m-d H:i:s");
	$archivo = fopen("error-log.txt", "a+");
	fwrite($archivo, $fecha_actual. "". $variable. "\n");
	fclose($archivo);
}
echo errorLog ($_REQUEST["txtEmail"]);








?>
<body>

</body>
</html>