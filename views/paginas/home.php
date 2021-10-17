



		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<?php foreach ($categorias as  $categoria):?>
						<!-- shop -->
							<div class="col-md-4 col-xs-6">
								<div class="shop animar-btn" data-categoria="<?php echo $categoria['id']; ?>">
									<div class="shop-img" data-categoria="<?php echo $categoria['id']; ?>">
										<img src="../imagenes_categorias/<?php echo $categoria["imagen"];  ?>" alt="<?php echo $categoria['nombre']; ?>">
								</div>
								<div class="shop-body" data-categoria="<?php echo $categoria['id']; ?>">
										<h3> <?php $cat = explode(" ",$categoria["nombre"]); echo $cat[0];if(isset($cat[1])){ echo "<br>"; echo $cat[1];}; ?> </h3>
										<a href="tienda?categoria=<?php echo $categoria['id']; ?>" class="cta-btn">Ver Ahora <i class="fa fa-arrow-circle-right"></i></a>
								</div>
								</div>
							</div>
							<!-- /shop -->
							<?php endforeach; ?>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Productos de Ofertas</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
								<?php foreach ($categorias as  $categoria):?>

							<li><a data-toggle="tab"  href="tienda?categoria=<?php echo $categoria["id"]; ?>"><?php echo $categoria["nombre"]; ?></a></li>
					<?php endforeach; ?>


								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">

										<?php foreach($productos as $producto):?>

											<?php

											$imagenes = $producto->obtenerImagenes();

										?>
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="../imagenes_productos/<?php echo $imagenes[0]?>"  data-id="<?php echo $producto->id; ?>" alt="">
												<div class="product-label">
													<span class="sale">-<?php echo $producto->descuento; ?>%</span>
													<span class="new">OFERTA</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Auriculares</p>
												<h3 class="product-name"><a href="producto?id=<?php echo  $producto->id; ?>"><?php echo $producto->nombre; ?></a></h3>
												<h4 class="product-price">$<?php echo $producto->precio; ?> <del class="product-old-price">$<?php echo $producto->precio_anterior; ?></del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Añadir a Favoritos</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Comparar</span></button>
													<button class="quick-view" data-id="<?php echo $producto->id; ?>"><i class="fa fa-eye"></i><span class="tooltipp">Vista Rapida</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn" data-id="<?php echo $producto->id; ?>"><i class="fa fa-shopping-cart"></i> Añadir al Carrito </button>
											</div>
										</div>
										<!-- /product -->
									<?php endforeach; ?>

									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3 id="dias">02</h3>
										<span>Dias</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="horas">10</h3>
										<span>Horas</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="minutos">34</h3>
										<span>Minutos</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="segundos">60</h3>
										<span>Segundos</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase"> Semana de Ofertas </h2>
							<p>Solo por esta semana un 10% OFF en tus compras</p>
							<p>Y vos, ¿ Te lo vas a perder ?</p>
							<a class="primary-btn cta-btn animar-btn" href="tienda?categoria=1"> Comprar Ahora </a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Lo más Vendido</h3>

						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php foreach($mas_vendidos as $mas_vendido):?>

											<?php

											$imagenes = $mas_vendido->obtenerImagenes();

										?>
												<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="../imagenes_productos/<?php echo $imagenes[0]?>" data-id="<?php echo $mas_vendido->id; ?>"  alt="">
												<div class="product-label">
													<span class="sale">-<?php echo $mas_vendido->descuento; ?>%</span>
													<span class="new">OFERTA </span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Auriculares</p>
												<h3 class="product-name"><a href="producto?id=<?php echo  $mas_vendido->id; ?>"><?php echo $mas_vendido->nombre;?></a></h3>
												<h4 class="product-price">$<?php echo $mas_vendido->precio; ?> <del class="product-old-price">$<?php echo $mas_vendido->precio_anterior; ?></del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Añadir a Favoritos</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Comparar</span></button>
													<button class="quick-view" data-id="<?php echo $producto->id; ?>"><i class="fa fa-eye"></i><span class="tooltipp">Vista Rapida</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn" data-id="<?php echo $producto->id; ?>"><i class="fa fa-shopping-cart"></i> Añadir a Carrito </button>
											</div>
										</div>
										<!-- /product -->
											<?php endforeach; ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Productos de Calidad: </h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>

							<?php foreach($productos_calidad as $producto_calidad){

								$prod_calidad = $producto_calidad[0];

											$imagenes = $prod_calidad->obtenerImagenes();



							?>
							<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="../imagenes_productos/<?php echo $imagenes[0]?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php foreach ($categorias as $cat){
													if($cat["id"]==$prod_calidad->id_categoria){
														echo $cat["nombre"];
													} } ?></p>

										<h3 class="product-name"><a href="producto?id=<?php echo $prod_calidad->id; ?>"><?php echo $prod_calidad->nombre; ?></a></h3>
										<h4 class="product-price">$<?php echo $prod_calidad->precio; ?><del class="product-old-price">$<?php echo $prod_calidad->precio_anterior; ?></del></h4>
									</div>
								</div>
								<!-- /product widget -->

							<?php	} ?>


						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

