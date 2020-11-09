<?php
// datos del posible cliente
$nombre = ucwords($_POST[nombre]);
$email = $_POST[email];
$mensaje = $_POST[mensaje];

// datos para envio
$destinatario = 'danilo.j.gonzalez@gmail.com';

// Validacion de campos
if (empty($nombre) || strlen($nombre) < 3 || is_numeric($nombre) || is_numeric(substr($nombre, 0, 1))) {
    echo "error nombre";
} elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "error email";
} elseif (empty($mensaje) || strlen($mensaje) > 400) {
    echo "error mensaje";
} else {
    $asunto = "ComercioIT - Contacto: " . $email;
    $cabecera = "From: info@comercioit.com" . "\r\n";
    $cuerpo = "<h1>ComercioIT - Datos de Contacto</h1>" . "<p><strong>Nombre: </strong>$nombre</p>" . "<p><strong>Email: </strong>$email</p>" . "<p><strong>Mensaje: </strong></br>$mensaje</p>";
}

mail($destinatario, $asunto, $cuerpo, $cabecera);
if (mail($destinatario, $asunto, $cuerpo, $cabecera)) {
    echo "Consulta enviada";
} else {
    echo "Consulta NO envida";
}

