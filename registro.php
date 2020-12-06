<?php
require 'PHPMailer/PHPMailerAutoload.php';
$token = RegistroCliente($nombre, $apellido, $email, $pass);

if ($token != 0) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recolexion de variables
        $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
        $apellido = isset($_REQUEST['apellido']) ? $_REQUEST['apellido'] : null;
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;        

		$emailEnvio = '';
		$passEmailEnvio = '';
		$nombreEmailEnvio = 'Prueba';
		$apellidoEmailEnvio = 'PHPMailer';
		
		date_default_timezone_set('America/Tegucigalpa');	

		$mail = new PHPMailer;
		$mail->isSMTP();        
		$mail->SMTPDebug = 0;        
		$mail->Debugoutput = 'html';        
		$mail->Host = 'smtp.gmail.com';        
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $emailEnvio;
		$mail->Password = $passEmailEnvio;
		$mail->setFrom($emailEnvio, $nombreEmailEnvio . " " . $apellidoEmailEnvio);
		$mail->addAddress($email, $nombre . " " . $apellido);
		$mail->Subject = 'Validacion de cuenta de correo';        
		$mail->Body    = "Hola " . $nombre . " " . $apellido. " Haz click en el link adjunto para validar tu token: http://localhost:8848/EducacionIT/Programaci%C3%B3n_Web_en_PHP_y_MySQL/ComercioIT/index.php?page=validacion&token=" . $token;

		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			// echo "Message sent!";            
		}
	}
}
?>

<div class="register">
	<div class="register-top-grid">
		<h3>NUEVO USUARIO</h3>
		<form action="#" method="post">
			<div class="mation">
				<span>Nombre: <label>*</label></span>
				<input type="text" name="nombre"> 
				<span>Apellido: <label>*</label></span>
				<input type="text" name="apellido"> 
				<span>E-Mail: <label>*</label></span>
				<input type="text" name="email">
				<span>Contraseña: <label>*</label></span>
				<input type="password" name="pass">
				<div class="register-but">
					<input type="submit" value="Registrarme">
				</div>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>
</div>