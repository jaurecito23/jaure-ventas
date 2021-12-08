

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="/accesorios/ventas-jaure">Home</a></li>
							<li><a href="/accesorios/ventas-jaure">Categorias</a></li>
							<li><a href="/accesorios/ventas-jaure/tienda?categoria=<?php echo $categoria_actual["id"];?>"><?php echo $categoria_actual["nombre"];?></a></li>
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


					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Filtrar Por:
									<select class="input-select filtrar-descuento" data-categoria="<?php echo $categoria_actual["id"]?>">
										<option value="0">Precio</option>
										<option value="1">Descuento</option>
									</select>
								</label>

								<label>
									Mostrar:
									<select class="input-select cambiar-cantidad">
										<option value="9">9</option>
										<option value="18">18</option>
									</select>
								</label>
							</div>
							<!-- <ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
							 <li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul> -->
						</div>
						<!-- /store top filter -->

						<!-- store products -->



						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Precio</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<div class="row productos-tienda" id="productos-tienda">
												<?php $id_ultimo_producto = 0;?>
												<?php $id_primer_producto = 0;?>
												<?php $primer_producto = true;?>

                            <?php foreach($productos as $producto):?>

                            <?php

                            $imagenes = $producto->obtenerImagenes();






								$id_ultimo_producto = $producto->id;




								if($primer_producto){

									$id_primer_producto = $producto->id;
									$primer_producto = false;

								}

					?>
                            <!-- product -->
                            <div class="col-md-4 col-xs-6">
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
                            </div>
                            <!-- /product -->
                            <div class="clearfix visible-sm visible-xs"></div>
                            <?php endforeach; ?>



						</div>
						<!-- /store products -->

						<input type="hidden" class="ultimo-producto" value="<?php echo $id_ultimo_producto;?>">
						<input type="hidden" class="primer-producto" value="<?php echo $id_primer_producto;?>">

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty"></span>
							<ul class="store-pagination">

							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
									<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categorias</h3>
							<div class="checkbox-filter">

                            <?php  foreach ($categorias as $cat):?>
								<div class="input-checkbox">
									<input type="radio" name="categorias" class="filtrar-por-categoria" data-id="<?php echo $cat["id"];?>" id="categoria-<?php echo $cat["id"];?>">
									<label for="categoria-<?php echo $cat["id"];?>">
										<span></span>
										<?php echo $cat["nombre"]; ?>
										<small><?php  echo $cantidad_productos[$cat["id"]]["count(nombre)"] ?> </small>
									</label>
								</div>
                                <?php endforeach; ?>

							</div>
						</div>
						<!-- /aside Widget -->


						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Marcas</h3>
							<div class="checkbox-filter">

                            <?php foreach ($marca_productos as $marca):?>

                                <div class="input-checkbox">
									<input type="radio" class="filtrar-marca" name="marcas" id="<?php echo $marca["marca"];?>">
									<label for="<?php echo $marca["marca"];?>">
										<span></span>
										<?php echo $marca["marca"]; ?>
										<small>(<?php echo $marca["count(id_producto)"]?>)</small>
									</label>
								</div>
                                <?php endforeach; ?>

							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Productos de Calidad</h3>



                            <?php foreach($productos_calidad as $producto_calidad){

                            $prod_calidad = $producto_calidad[0];

                            $imagenes = $prod_calidad->obtenerImagenes(); ?>

                            <!-- aside Widget -->

                                    <div class="product-widget">
                                    <div class="product-img">
                                    <img src="../imagenes_productos/<?php echo $imagenes[0]?>" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?php foreach ($categorias as $cat){
                                                if($cat["id"]==$prod_calidad->id_categoria){
                                                    echo $cat["nombre"];
                                                } } ?></p>
                                        <h3 class="product-name"><a href="/accesorios/ventas-jaure/producto?id=<?php echo $prod_calidad->id;?>"><?php echo $prod_calidad->nombre; ?></a></h3>
                                        <h4 class="product-price">$<?php echo $prod_calidad->precio; ?> <del class="product-old-price">$<?php echo $prod_calidad->precio_anterior; ?></del></h4>
                                    </div>
                                </div>

                                <?php	} ?>

						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->


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
