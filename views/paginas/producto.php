

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="/accesorios/ventas-jaure/">Home</a></li>
							<li><a href="/accesorios/ventas-jaure/">Categorias</a></li>
							<li><a href="/accesorios/ventas-jaure/tienda?categoria=<?php echo $categoria_actual["id"]?>"><?php echo $categoria_actual["nombre"]; ?></a></li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">

                            <?php $imagenes = $producto->imagenes;

                                foreach($imagenes as $imagen){?>

                            <div class="product-preview">
								<img src="../imagenes_productos/<?php echo $imagen;?>" alt="">
							</div>

                            <?php } ?>

						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
                            <?php $imagenes = $producto->imagenes;
                        foreach($imagenes as $imagen){?>

                            <div class="product-preview">
                                 <img src="../imagenes_productos/<?php echo $imagen;?>" alt="">
                                </div>

                            <?php }?>

						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $producto->nombre; ?></h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#"> Añade tu reseña. </a>
							</div>
							<div>
								<h3 class="product-price">$<?php echo $producto->precio; ?><del class="product-old-price">$<?php echo $producto->precio_anterior; ?></del></h3>
								<span class="product-available">En Stock</span>
							</div>
							<p><?php echo $producto->descripcion;?></p>

							<!-- <div class="product-options">
								<label>
									 Color:
                                     <input class="input-select" type="text">
									<select class="input-select">
										<option value="0"></option>
									</select> -->
								<!-- </label> -->
							<!-- </div> -->

							<div class="add-to-cart">
								<!-- <div class="qty-label">
									Cantidad:
									<div class="input-number">
										<input type="number" min="1" max="10" require>
									</div>
								</div> -->
								<button class="add-to-cart-btn" data-id="<?php echo $producto->id; ?>"><i class="fa fa-shopping-cart"></i> Añadir al Carrito </button>
							</div>

							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> Añadir a Favoritos </a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> Comparar </a></li>
							</ul>

							<ul class="product-links">
								<li>Categoria:</li>
								<li><a href="/accesorios/ventas-jaure/tienda?id=<?php  echo $categoria_actual["id"]; ?>"><?php echo $categoria_actual["nombre"];?></a></li>
							</ul>

							<ul class="product-links">
								<li>Compartir en:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Descripcion</a></li>
								<li><a data-toggle="tab" href="#tab2">Detalles</a></li>
								<li><a data-toggle="tab" href="#tab3">Reseñas (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p><?php echo $producto->descripcion; ?></p>
										</div>
									</div>
								</div>
									<div class="row">
										<div class="col-md-12">
											<p><?php echo $detalles["descripcion"]; ?></p>
										</div>
										<div class="col-md-12">
											<p>Marca: <?php echo $detalles["marca"]; ?></p>
										</div>
										<div class="col-md-12">
											<p>Modelo: <?php echo $detalles["modelo"]; ?></p>
										</div>
									</div>
								</div>
									
								</div>
								<!-- /tab1  -->
								

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span class="promedio">4.5</span>
													<div class="rating-stars promedio-estrellas">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div class="barra_5" style="width: 80%;"></div>
														</div>
														<span class="sum puntaje_5">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div class="barra_4" style="width: 60%;"></div>
														</div>
														<span class="sum puntaje_4">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>

														</div>
														<div class="rating-progress">
															<div class="barra_3" ></div>
														</div>
														<span class="su puntaje_3">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div class="barra_2"></div>
														</div>
														<span class="sum puntaje_2">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div class="barra_1"></div>
														</div>
														<span class="sum puntaje_1">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews opiniones_usuarios">
													


												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form formulario-puntaje" data-id="<?php echo $producto->id;?>">
													<input class="input opinion-nombre" type="text" placeholder="Tu Nombre">
													<input class="input opinion-email" type="text" placeholder="Tu Email o Celular">
													<textarea class="input opinion-opinion" placeholder="Tu Opinion del Producto"></textarea>
													<div class="input-rating">
														<span>Puntaje: </span>
														<div class="stars">
															<input id="star5" class="opinion-puntaje" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" class="opinion-puntaje" name="rating"  value="4" type="radio"><label for="star4"></label>
															<input id="star3" class="opinion-puntaje" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" class="opinion-puntaje" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" class="opinion-puntaje" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Enviar</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Otros Productos</h3>
						</div>
					</div>

                            <?php foreach($productos as $producto): ?>

								<?php
											$imagenes = $producto->obtenerImagenes();
										?>
					<!-- product -->
					<div class="col-md-3 col-xs-6">
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
					</div>
					<!-- /product -->


                                <?php endforeach; ?>


				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->
