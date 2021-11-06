


<?php foreach ($errores as $error):?>
  <div id="toastsContainerTopRight" class="toasts-top-right fixed"><div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong><small>Jaure Ventas</small><button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="toast-body"><?php echo $error;?></div></div></div>

  <?php endforeach;?>

  <?php if($respuesta && $respuesta=="exito"):?>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"><div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Excelente</strong><small>Jaure Ventas</small><button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="toast-body">Se creo Correctamente</div></div></div>
  <?php endif;?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear Administrador.</h1>
            <small>LLena el formulario para crear un Administrador</small>
          </div>
          <div class="col-sm-6">

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <div class="row">
                  <div class="col-md-8">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Crear Administrador</h3>


        </div>

        <!-- FORMULARIO -->

        <div class="card-body">
            <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Usuario Administrador</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


                  <form class="form-horizontal" name="crear-admin"  method="POST">
                      <div class="card-body">

                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Usuario: </label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" id="usuario"  name="usuario" placeholder="Usuario">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="contraseña" class="col-sm-2 col-form-label">Nivel</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="nivel">
                          <option value="1"> Acceso Toal</option>
                            <option value="2"> Solo CRUD </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="contraseña" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="contraseña" name="password" placeholder="Contraseña">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Recuerdame</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                  <input type="submit"  class="btn btn-info" value="Añadir">
                  <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>


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


