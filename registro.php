<!DOCTYPE html>
<html>
	<head>
	<title>ComercioIT | Tu E-Shop en PHP</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!--theme-style-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
	<!--//theme-style-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!--fonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<!--//fonts-->
	<script src="js/jquery.min.js"></script>
	<!--script-->
	</head>
	<body> 
		<!--header-->
		<div class="header">
			<div class="bottom-header">
				<div class="container">
					<div class="header-bottom-left">
						<div class="logo"><a href="index.php">Comercio<strong>IT</strong></a></div>
						<!--div class="search">
							<input type="text" name="q">
							<input type="submit" value="BUSCAR">
						</div-->
						<div class="clearfix"></div>
					</div>
					<div class="header-bottom-right">					
						<!--div class="account">
							<a href="ingreso.html"><span></span> TU CUENTA</a>
						</div-->
						<ul class="login">
							<li><a href="ingreso.php"><span></span> INGRESAR</a></li>
							&nbsp;|&nbsp;
							<li><a href="registro.php">REGISTRARME</a></li>
							&nbsp;|&nbsp;
							<li><a href="contacto.php">CONTACTO</a></li>
						</ul>
						<!--div class="cart"><a href="#"><span></span>CART</a></div-->
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>	
				</div>
			</div>
		</div>
		<!---->
		<div class="container">
			<section id="page">
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

			</section>
			<div class="clearfix"></div>
		</div>

		<!---->
		<div class="footer">
			<div class="footer-top">
				<div class="container">
					<div class="latter">
						<h6>LA MEJOR MANERA DE COMPRAR ONLINE!</h6>
						<div class="clearfix"></div>
					</div>
					<div class="latter-right">
						<p>SEGUINOS</p>
						<ul class="face-in-to">
							<li><a href="#"><span></span></a></li>
							<li><a href="#"><span class="facebook-in"></span></a></li>
							<div class="clearfix"></div>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container">
					<div class="footer-bottom-cate cate-bottom">
						<h6>DIRECCIÓN</h6>
						<ul>
							<li>Lavalle 648, 8° Piso</li>
							<li>C.A.B.A.</li>
							<li>Buenos Aires</li>
							<li>Argentina</li>
							<li class="phone">(011) 4328-0457</li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<!--initiate accordion-->
		<script src="js/custom.js"></script>
	</body>
</html>