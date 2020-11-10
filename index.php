<?php	
include 'header.php'; 
require_once 'functions.php';

if (isset($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = "inicio";
}
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