
         <?php   if(!$actualizadaContraseña):?>
  <?php if($existeCodigo->num_rows > 0): ?>


                  <form class="formulario-ingresar" method="POST">
                    <div class="col-md-6">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Cambia tu contraseña ahora mismo</h3>
							</div>

                            <div class="input-checkbox">

                                <p>Ingrese su nueva contraseña</p>

                                <input class="input contraseña1" type="password" name="contrasena1" placeholder="Escribe tu contraseña*">
                                <br>
                                <p>Ingrese nuevamente su contraseña</p>

                                <input class="input contraseña1" type="password" name="contrasena2" placeholder="Escribe tu contraseña*">
                                <br>

                              <div class="input-checkbox">

							<input type="checkbox" class="mostrar-contraseñas" id="mostrar-contraseñas">
							<label for="mostrar-contraseñas">
                                <span style="border: 1.2px solid #15161D;"></span>
								Mostrar Mis Contraseñas
							</label>
                          </div>

                            </div>

						</div>
						<!-- /Billing Details -->


                        <div class="errores-form">

                            <?php foreach($errores as $error):?>

                                  <p style="color: red;"> <?php echo $error; ?> </p>

                                <?php endforeach; ?>
                        </div>

                        <div class="contenedor-btn-crearcuenta">
                            <input type="submit" class="primary-btn btn-crearcuenta order-submit" value="Cambiar Contraseña">
                        </div>
                        <br><br>

					</div>
                </form>


                <?php else: ?>

                  <div class="errores-form expiro-enlace" >

                          <p>Este enlace ya expiro.</p>
                          <a class="btn-success btn" href="/accesorios/ventas-jaure">Ir a Home</a>
                    </div>


                  <?php endif;?>



                  <?php   else: ?>

                        <div class="errores-form expiro-enlace" style="display: flex; flex-direction:column;align-items:center; justify-content: center;" >
                           <p style="color: green;">Excelente, la contraseña fue actualizada.</p>
                           <a class="btn-success btn" href="/accesorios/ventas-jaure/ingresar">Iniciar Session</a>
                       </div>

                       <script>

                        setTimeout(() => {

                            window.location.href = "/accesorios/ventas-jaure/ingresar";

                        }, 2000);


                       </script>

                    <?php endif;?>