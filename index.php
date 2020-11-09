<?php	
include 'header.php'; 
require_once 'functions.php';
$page = $_GET[page];
?>

<div class="container">
	<section id="page">
		<?php
			CargarPagina($page);
		?>
	</section>
	<div class="clearfix"></div>
</div>

<?php include 'footer.php'; ?>