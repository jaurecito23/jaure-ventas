
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Jaure Ventas</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="../css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="../css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->

		<script src="https://kit.fontawesome.com/54efbbc263.js" crossorigin="anonymous"></script>

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="../css/style.css"/>
		<link type="text/css" rel="stylesheet" href="build/css/app.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +598 93 693 110</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> jaureventas1@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Canelones - Uruguay </a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> UY </a></li>

						<?php if($usuario && $usuario->nombres !== ""):?>
							<li><a class="usuario"><i class="fa fa-user-o"></i><?php echo $usuario->nombres; ?></a></li>

						<?php else:?>
						<li><a class="crear-ingresar"><i class="fa fa-user-o"></i>Crear cuenta/Iniciar Sesion</a></li>
						<?php endif;?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row contenedor-logo">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo" style="">
								<a href="/accesorios/ventas-jaure" class="logo">
									<img src="../img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<?php  foreach ($categorias as $categoria):?>
										<option value="<?php echo $categoria["id"];?>"><?php echo substr($categoria["nombre"],0,7); echo "..."?></option>

										<?php endforeach; ?>
									</select>
									<input class="input input-buscar" placeholder="Encuentra los mejores productos...">
									<button class="search-btn ">Buscar</button>


								</form>

							   <div class="resultados-buscador" style="display: none">

							   </div>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">


								<!-- Favoritos -->
								<div class="dropdown favorito">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-heart-o"></i>
										<span>Tus Favoritos</span>
										<div class="qty cantidad">0</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list lista-favorito-list">

										</div>
									</div>
								</div>
								<!-- /Favoritos -->


								<!-- Cart -->
								<div class="dropdown carrito">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Tu  Carrito</span>
										<div class="qty cantidad">0</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list lista-carrito">

										</div>
										<div class="cart-summary">
											<small><span>3</span> Productos(s) seleccionados</small>
											<h5>SUBTOTAL: $<i style='font-size: 1.5rem; color: #11BD09'class='fas fa-circle-notch fa-spin'></i></h5>
										</div>
										<div class="cart-btns">
											<a href=/accesorios/ventas-jaure/pagar#pedido-orden>Ver Carrito</a>
											<a href="/accesorios/ventas-jaure/pagar">Terminar <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->


								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->


					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

			<!-- NAVIGATION -->
			<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="<?php if($pagina === "home"){ echo "active"; } ?>"><a href="/accesorios/ventas-jaure">Home</a></li>

						<!-- Se trae todas las categorias de la base de datos -->
						<?php foreach ($categorias as  $cat):?>

							<li class="<?php if($cat["nombre"] == $categoria_actual["nombre"] && $pagina !== "home" ){ echo "active";} ?>"><a href="tienda?categoria=<?php echo $cat['id']; ?>" ><?php echo $cat["nombre"]; ?></a></li>
					<?php endforeach; ?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->