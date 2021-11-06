<?php
if ($respuesta && $respuesta == "error") {
?>

<div id="toastsContainerTopRight" class="toasts-top-right fixed"><div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong><small>Jaure Ventas</small><button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="toast-body">No eres Administrador, estár en está sección esta prohibido.</div></div></div>

<?php }; ?>

<div class="login-box margin login-admin" >
  <div class="login-logo">
    <a href="../index.php"><b>Jaure</b>Ventas</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia sesión aquí</p>

      <form  name="login-admin-form" id="login-admin" method="POST" action="">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="usuario" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-12 text-center">
              <input type="hidden" name="login-admin" value="1">
            <input type="submit" class="btn btn-primary btn-block" value="Iniciar Sesión">
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


