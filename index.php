<?php	
include 'header.php'; 
require_once 'functions.php';
$page = $_GET[page];
$rta = $_GET[rta];
?>

<div class="container">
	<section id="page">
		<?php
		MostrarMensaje($rta);
		CargarPagina($page);
		?>
	</section>
	<div class="clearfix"></div>
</div>

<?php include 'footer.php'; ?>