<?php
/*Mensaje de error por envio de formulario*/
if (isset($_GET["rta"])) {
	echo MostrarMensaje($_GET["rta"]);
}
?>

<div class="main"> 
	<div class="reservation_top">
		<div class=" contact_right">
			<h3>Contacto</h3>
			<div class="contact-form">
				<form action="enviar.php" method="post">
					<input type="text" class="textbox" placeholder="Nombre" name="nombre">
					<input type="text" class="textbox" placeholder="E-Mail" name="email">
					<textarea placeholder="Mensaje" name="mensaje"></textarea>
					<input type="submit" value="Enviar">
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>
</div>

