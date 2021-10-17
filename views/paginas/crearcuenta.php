
                    <div style="color: red; text-align: center; margin: 2rem auto;">
            <?php foreach($errores as $error):?>

           

            <?php
                echo $error;
                
            endforeach; ?>
</div>



                  <form class="formulario formulario-crear" method="POST">
                    <div class="col-md-6">

                    	<!-- Billing Details -->
    <div class="billing-details">
							<div class="section-title">
								<h3 class="title">Crea tu Cuenta</h3>
							</div>

                            <?php include __DIR__."/../templates/formulario-usuario.php"; ?>

                            <div class="input-checkbox">
                                
                                <p>Crea una contraseña</p>
                                <p>Minimo 8 caracteres.</p>
                                <input class="input contraseña" value="<?php echo $usuario->contrasena; ?>" type="password" name="usuario[contrasena]" placeholder="Escribe tu contraseña*">
                                <br> <br>
                                <input class="input contraseña2" type="password" name="usuario[contraseña2]" placeholder="Repite tu contraseña*">
                                <p class="contraseñas-error parrafo-error">Las contraseñas no coinciden.</p>
                                <p class=" parrafo-error">Las contraseñas no son válidas, deben tener minimo 8 caracteres.</p>
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

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" value="<?php echo $usuario->notas; ?>" name="usuario[notas]" placeholder="Otras Notas"></textarea>
						</div>
						<!-- /Order notes -->

                    
						<div class="input-checkbox">
							<input type="checkbox" name="usuario[terminos]" class="terminos" id="terms">
							<label for="terms">
                                <span style="border: 1.2px solid #15161D;"></span>
								Acepto los <a href="#">terminos & condiciones de jaureventas.</a>
							</label>
                            <p class="parrafo-error">Debes aceptar los <a href="#">terminos & condiciones de jaureventas.</a></p>
						</div>


                        <div class="errores-form">



                        </div>

                        <div class="contenedor-btn-crearcuenta">
                            <input type="button" class="primary-btn btn-crearcuenta order-submit" value="Crear Cuenta">
                        </div>

					</div>
                </form>