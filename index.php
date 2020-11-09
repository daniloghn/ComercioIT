<?php	
include 'header.php'; 
?>

<div class="container">
	<section id="page">
		<?php
		if (isset($_GET[page])) {
			$page = $_GET[page]; 
			include($page . ".php");
		} else {
			include 'inicio.php';
		}
		?>
	</section>
	<div class="clearfix"></div>
</div>

<?php include 'footer.php'; ?>