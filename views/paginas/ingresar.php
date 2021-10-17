


                  <form class="formulario-ingresar" method="POST">
                    <div class="col-md-6">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Inicia Sesion Ahora mismo</h3>
							</div>

							<div class="form-group">
								<input class="input email" type="text" name="email" placeholder="Tu Email o Tu celular">
							</div>

                            <div class="input-checkbox">

                                <p>Ingrese su contraseña</p>

                                <input class="input contraseña1" type="password" name="contrasena" placeholder="Escribe tu contraseña*">
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
                            <input type="submit" class="primary-btn btn-crearcuenta order-submit" value="Iniciar Sesion">
                        </div>
                        <br><br>
            <!-- Cambiar contraseña -->
                      <div class="boton-cambiar-contraseña-ingresar">

        <a class="olvide-contraseña-ingresar"> ¿ Olvidaste tu contraseña ? </a>
        <button  type="button" class="btn-success olvide-contraseña-ingresar"> Has click aquí </button>
        </div>
         <br><br>
          <!-- Cambiar contraseña -->

					      </div>
              </form>