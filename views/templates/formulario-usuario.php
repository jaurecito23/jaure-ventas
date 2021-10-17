
							<div class="form-group">
                                <input class="input nombres" data-tipo="nombres" value="<?php echo $usuario->nombres; ?>" type="text" name="usuario[nombres]" placeholder="Tus Nombres*">
                                <p class="parrafo-error">Debes Agregar un Nombre ( Mayor a 2 letras ).</p>
							</div>
							<div class="form-group">
								<input class="input apellidos" data-tipo="apellidos" value="<?php echo $usuario->apellidos; ?>" type="text" name="usuario[apellidos]" placeholder="Tus Apellidos*">
                                <p class="parrafo-error">Debes Agregar un Apellido ( Mayor a 2 letras ).</p>
							</div>
							<div class="form-group">
								<input class="input email" data-tipo="email" value="<?php echo $usuario->email; ?>" type="email" name="usuario[email]" placeholder="Tu Email">
                                <p class="parrafo-error">Debes Agregar un Email Válido.</p>
							</div>
							<div class="form-group">
                                <input class="input direccion" data-tipo="direccion" value="<?php echo $usuario->direccion; ?>" type="text" name="usuario[direccion]" placeholder="Dirección">
                                <p class="parrafo-error">Debes Añadir una dirección (La usaremos para enviar los pedidos, minimo 8 caracteres).</p>
							</div>
							<div class="form-group">
                                <input class="input ciudad" data-tipo="ciudad" value="<?php echo $usuario->ciudad; ?>" type="text" name="usuario[ciudad]" placeholder="Ciudad*">
                                <p class="parrafo-error">Debes Añadir tu ciudad.</p>
							</div>
							<div class="form-group">
                                <input class="input localidad" data-tipo="localidad" value="<?php echo $usuario->localidad; ?>" type="text" name="usuario[localidad]" placeholder="Localidad/Pueblo">
                                <p class="parrafo-error">Debes Añadir tu Localidad o Pueblo</p>
							</div>
							<div class="form-group">
                                <input class="input celular" data-tipo="celular" value="<?php echo $usuario->celular; ?>" type="tel" name="usuario[celular]" placeholder="Tu Celular*">
                                <p class="parrafo-error">Debes Añadir tu Celular (Para que te podamos contactar), ejemplo 093693110.</p>
							</div>

							<?php if($pagina != "crearcuenta"):?>
								<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" data-tipo="notas" placeholder="Otras Notas"> <?php echo  $usuario->notas; ?> </textarea>
						</div>
						<!-- /Order notes -->
						<div class="errores-form">

						</div>

								<?php endif;?>