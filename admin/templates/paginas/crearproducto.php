


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear Producto.</h1>
            <small>LLena el formulario para crear un Producto</small>
          </div>
          <div class="col-sm-6">

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php if(!empty($errores) || !empty($erroresDetalles)):?>
      <?php foreach ($errores as $error): ?>
        <div class="errores">

          <p><?php echo $error; ?></p>

        </div>
          <?php endforeach;?>
          <?php foreach($erroresDetalles as $error): ?>
            <div class="errores">

          <p><?php echo $error; ?></p>
        </div>

        <?php endforeach;?>

    <?php endif;?>

    <?php if($resultadoAccion):?>

    <div class="resultado-accion">

    <?php

        if($resultadoAccion == 1){

          echo "<p> El producto se creo Correctamente. </p>";

        }
          ?>

      </div>
      <?php endif;?>


    <!-- Abre el FORM de Creacion  -->
    <form method="POST" enctype="multipart/form-data">

    <!-- PRIMERA PARTE  -->
    <div class="row" id="parte-1">
      <div class="col-md-10">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Crear Producto</h3>


        </div>

        <!-- FORMULARIO -->

        <div class="card-body">
            <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Nuevo Producto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


                  <div class="form-horizontal formulario-crear-producto"  method="POST" action="">
                      <div class="card-body">

                  <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre: </label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" id="nombre"  name="producto[nombre]" placeholder="Nombre del Producto">
                      <div class="col-sm-10">
                        <p class="error">Debe tener menos de 35 caracteres.</p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="precio" class="col-sm-2 col-form-label">Precio: </label>
                    <div class="col-sm-10">
                      <input type="number"  class="form-control" id="precio"  name="producto[precio]" placeholder="Precio de Producto">
                      <div class="col-sm-10">
                        <p class="error">El numero 0 es "Sin Stock".</p>
                      </div>
                    </div>
                  </div>


                  <div class="form-group row">
                  <label>Categoria</label>
                  <select name="producto[id_categoria]" class="form-control" >
                    <option selected disabled>--Seleccione--</option>
                     <?php foreach($categorias as $categoria):?>
                    <option value="<?php echo $categoria["id"]; ?>"><?php echo $categoria["nombre"];?></option>
                    <?php endforeach;?>
                  </select>
                  <p class="error"> Debes seleccionar la categoria del producto. </p>
                </div>

                <div class="form-group row">
                    <label for="descuento" class="col-sm-2 col-form-label">Descuento: </label>
                    <div class="col-sm-10">
                      <input type="number"  class="form-control" id="descuento"  name="producto[descuento]" placeholder="Cantidad en Porcentaje">
                      <div class="col-sm-10">
                        <p class="error">Debes introducir un Descuento</p>
                      </div>
                    </div>
                  </div>

                <div class="form-group row">
                    <label for="precio" class="col-sm-2 col-form-label">Precio Anterior: </label>
                    <div class="col-sm-10">
                      <input type="number"  class="form-control" id="precio"  name="producto[precio_anterior]" placeholder="Ingresa Precio Anterior">
                      <div class="col-sm-10">
                        <p class="error">Debes introducir un precio anterior.</p>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="descripcion" class="col-sm-2 col-form-label">Descripcion: </label>
                    <div class="col-sm-10">
                      <textarea   class="form-control" id="descripcion"  name="producto[descripcion]"> </textarea>
                      <div class="col-sm-10">
                        <p class="error">Debes introducir una descripcion , máximo 120 caracteres.</p>
                      </div>
                    </div>
                  </div>



                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="agregar-admin" value="1">
                  <button type="button"  data-siguiente="parte-2" class="btn btn-info btn-siguiente-crear-producto">Siguiente</button>
                  <button type="submit" class="btn btn-default float-right">Cancelar</button>
                </div>
                <!-- /.card-footer -->
                     </div>


            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->



            <!-- FORMULARIO -->

          </section>
    <!-- /.content -->

  </div>
              </div>

  <!-- PRIMERA PARTE  -->


  <!-- SEGUNDA PARTE  -->

  <div class="row hidden" id="parte-2">
      <div class="col-md-10">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detalles</h3>


        </div>

        <!-- FORMULARIO -->

        <div class="card-body" >
            <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Ingresar Detalles</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


                  <div class="form-horizontal" >
                      <div class="card-body">

                  <div class="form-group row">
                    <label for="descripcion-mayor" class="col-sm-2 col-form-label">Descripción Detallada: </label>
                    <div class="col-sm-10">
                      <textarea type="text"  class="form-control" id="descripcion-mayor"  name="detalles[descripcion-mayor]" ></textarea>

                      <div class="col-sm-10">
                        <p class="error">Debe tener menos de 150 caracteres.</p>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="marca" class="col-sm-2 col-form-label">Marca: </label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" id="marca"  name="detalles[marca]" placeholder="Marca del Producto">
                      <div class="col-sm-10">
                        <p class="error">Debe tener menos de 30 caracteres.</p>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="modelo" class="col-sm-2 col-form-label">Modelos: </label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" id="modelo"  name="detalles[modelo]" placeholder="Modelo del Producto">
                      <div class="col-sm-10">
                        <p class="error">Debe tener menos de 30 caracteres.</p>
                      </div>
                    </div>
                  </div>




                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="agregar-admin" value="1">
                    <button type="button" data-siguiente="parte-3" class="btn btn-info btn-siguiente-crear-producto">Siguiente</button>
                  <button type="submit" class="btn btn-default float-right">Cancelar</button>
                </div>
                <!-- /.card-footer -->
                     </div>


            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->



            <!-- FORMULARIO -->

          </section>
    <!-- /.content -->

  </div>
              </div>


  <!-- SEGUNDA PARTE  -->
  <!-- TERCERA PARTE  -->

  <div class="row hidden" id="parte-3">
      <div class="col-md-10">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Imagenes</h3>


        </div>

        <!-- FORMULARIO -->

        <div class="card-body">
            <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Insertar Imagen</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


                  <div class="form-horizontal">
                      <div class="card-body">

                  <div class="form-group row">
                    <label for="descripcion-mayor" class="col-sm-2 col-form-label">Ingresar Imagen</label>
                    <div class="col-sm-10">

                      <div class="ingresar-imagen" data-imagen="1">
                      <div>
                        <label for="imagen-1"><i class="fas fa-images"><p> Img 1 </p></i></label>

                        <input type="file" acept="image/jpg" id="imagen-1" class="form-control hidden"  name="producto[imagenes][imagen-1]" placeholder="Imagenes del Producto">
                      </div>

                      <button type="button"  data-imagen="1" class="btn-añadir-imagen"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                  </div>



                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="agregar-admin" value="1">
                  <button type="submit"  class="btn btn-info">Siguiente</button>
                  <button type="submit" class="btn btn-default float-right">Cancelar</button>
                </div>
                <!-- /.card-footer -->
                     </div>


            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->



            <!-- FORMULARIO -->

          </section>
    <!-- /.content -->

  </div>
              </div>


  <!-- TERCERA PARTE  -->

</form>
<!-- Cierra el FORM de Creacion  -->