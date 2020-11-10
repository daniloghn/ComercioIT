<?php
/*validar que el metodo de envio sea post*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    /* datos del posible cliente */
    $nombre = ucwords($_POST["nombre"]);
    $email = $_POST["email"];
    $mensaje = $_POST["mensaje"];
    
    /* datos para envio */
    $destinatario = 'danilo.j.gonzalez@gmail.com';
    
    /* Validacion de campos */
    if (empty($nombre) || strlen($nombre) < 3 || is_numeric($nombre) || is_numeric(substr($nombre, 0, 1))) {
        header("Location: ./?page=contacto&rta=0x001");
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ./?page=contacto&rta=0x002");
    } elseif (empty($mensaje) || strlen($mensaje) > 400) {
        header("Location: ./?page=contacto&rta=0x003");
    } else {
    
        /* envio de correo */
        $asunto = "ComercioIT - Contacto: " . $email;
        $cabecera = "From: " . $email . "\r\n";
        $cabecera.= "MIME-Version: 1.0\r\n";
        $cabecera.= "Content-Type: text/html; charset=UTF-8\r\n";

        $cuerpo = "<h1>ComercioIT - Datos de Contacto</h1>";
        $cuerpo.= "<p><strong>Nombre: </strong>$nombre</p>";
        $cuerpo.= "<p><strong>Email: </strong>$email</p>";
        $cuerpo.= "<p><strong>Mensaje: </strong></br>$mensaje</p>";
    
        
        if (mail($destinatario, $asunto, $cuerpo, $cabecera)) {
            header("Location: ./?page=contacto&rta=0x004");
        } else {
            header("Location: ./?page=contacto&rta=0x005");
        }
    }    
} else {
    header("Location: ./?page=contacto");
}




