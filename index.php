<?php	
include 'header.php'; 
?>

<div class="container">
	<section id="page">
		<?php
		$page = $_GET[page]; 
		include($page . ".php");
		?>
	</section>
	<div class="clearfix"></div>
</div>

<?php include 'footer.php'; ?>