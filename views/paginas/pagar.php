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
							<li><a href="/accesorios/ventas-jaure/tienda?categoria=?>">Pagar</a></li>
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

				<div class="elegir-crear-nocrear">

					<?php if($usuario->nombres == ""):?>
						<a href="/accesorios/ventas-jaure/crearcuenta" class="button">Crear Cuenta</a>
						<button class="button seleccionado">Pagar sin crear Cuenta</button>
						<?php else:?>
							<button class="button seleccionado">Pagar con mi Cuenta</button>
						<?php endif; ?>

				</div>

				<form class="formulario formulario-datos-pagar .formulario-datos-cuenta">
					<div class="col-md-7">
						<!-- Billing Details -->

    <div class="billing-details">
							<div class="section-title">
								<h3 class="title">Ingresa tus datos</h3>
							</div>

						<?php include __DIR__."/../templates/formulario-usuario.php"; ?>


						</div>
						<!-- /Billing Details -->


					</div>
				</form>


					<!-- Order Details -->
					<div class="col-md-5 order-details" id="pedido-orden">
						<div class="section-title text-center">
							<h3 class="title">Tu orden</h3>
						</div>
						<div class="order-summary" >
							<div class="order-col">
								<div><strong>Producto</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">


								<?php $productos_filtrados = [];?>
								<?php $productos_cantidad = [];?>
								<?php foreach($productos as $producto){

									$id_producto = $producto->id;
									if(isset($productos_filtrados[$id_producto])){

										$productos_cantidad[$id_producto] = $productos_cantidad[$id_producto] + 1;


									}else{

										$productos_cantidad[$id_producto] = 1;
										$productos_filtrados[$id_producto] = $producto;

									}
								};?>

								<?php foreach($productos_filtrados as $producto):?>

								<div class="order-col">
									<div><?php echo$productos_cantidad[$producto->id];?>x <?php echo $producto->nombre;?></div>
									<div>$<?php echo $producto->precio;?></div>
								</div>
								<?php endforeach;?>

							</div>

							<div class="order-col">
								<div>Envio</div>
								<?php if(intval($total) > 450):?>
									<div><strong>FREE</strong></div>
									<?php else: ?>
										<div><strong>$65</strong></div>
										<?php endif;?>
									</div>
									<p style="color: grey;">En compras mayores a $450, el envio es gratis.</p>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$<?php echo $total;?></strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="section-title">
								<h3 class="title">Elige el metodo de pago.</h3>
							</div>


							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Transferencia Bancaria
								</label>
								<div class="caption">
									<p>Nuestra cuenta 625710735672, te escribiremos para que nos envies el comprobante.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" checked name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Mercado Pagos
								</label>
								<div class="caption">
									<p>Paga ahora mismo en nuestra web y termina tu compra.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal
								</label>
								<div class="caption">
									<p>Paga ahora mismo con PayPal y termina tu compra.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-4">
								<label for="payment-4">
									<span></span>
									Abitab
								</label>
								<div class="caption">
									<p>Con tu tarjeta prex o deposito en abitab, numero de c.i: 52763432, nombre Facundo Jauregui</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-5">
								<label for="payment-5">
									<span></span>
									Redpagos
								</label>
								<div class="caption">
									<p>Con tu tarjeta midinero o deposito en redpagos,numero de cuenta:  ,numero de c.i: 52763432, nombre Facundo Jauregui</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" checked require disabled id="terms">
							<label for="terms">
								<span></span>
								Acepto los <a href="#">terminos & condiciones de jaureventas.</a>
							</label>
						</div>
						<a href="#" style="display: none" class="primary-btn order-submit btn-terminar">Terminar Orden</a>

					<div class="div-Btn-Pago">


					</div>

					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->