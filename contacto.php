<?php 
include_once("PHPMailer/src/PHPMailer.php");
if (isset($_POST['btnEnviar'])) {
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "mail.ezequielromero1996.com.ar"; // SMTP a utilizar. Por ej. smtp.elserver.com
	$mail->Username = "info@ezequielromero1996.com.ar"; // Correo completo a utilizar
	$mail->Password = "3Z3Q.7034";
	$mail->Port = 25;
	$mail->From = "info@ezequielromero1996.com.ar"; // Desde donde enviamos (Para mostrar)
	$mail->FromName = "ezequielromero1996";
	$mail->AddBCC("ezequielromero1996@hotmail.com");
	
	$mail->Subject = "Website Contact Form";
	$mail->Body = "Recibiste un correo desde la página web";
	$mail->IsHTML(true);
	$exito = $mail->Send();
	$mail->ClearAllRecipients();
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
	<link href="css/fontawesome/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript"src="js/bootstrap.bundle.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	<title>Contacto</title>
</head>
<body>
   <?php include_once("menu.php"); 
   ?>
	<div class="container">
		<section class="contenido" id="contacto">
			<div class="row">
				<div class="col-10">
					<h1>¡Trabajemos juntos!</h1>
				</div>
			</div>
			<div class="row">
			<div class="col-8">
				<h2>Si te interesa saber más de mí, pongamonos en contacto!</h2>
			</div>
			</div>
	<div class="row">
		<div class="col-10">
	<form action="" method="post">
		<div class="row">
		<div class="col-sm-6 form-group">
	<input type="text" name="txtNombre" id="txtNombre" class="form-control" placeholder="NOMBRE">
		</div>
		<div class="col-sm-6 form-group">
			<input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="EMAIL">
		</div>
		</div>
		<div class="col-sm-10 form-group">
				<input type="text" name="txtAsunto" id="txtAsunto" class="form-control" placeholder="ASUNTO">
		</div>
		<div class="col-sm-10 form-group">
			<textarea name="txtMensaje" class="form-control" name="txtMensaje" id="txtMensaje" rows="8" placeholder="MENSAJE"></textarea>
		</div>
	<div class="row">
			<div class="offset-sm-5">
			<input type="submit" name="btnENVIAR" type="btn">
		</div>
		</div>
		</div>
</div>
	</form>
    		</section>
</div>
<?php include_once("footer.php"); ?>
</div>
</body>
</html>