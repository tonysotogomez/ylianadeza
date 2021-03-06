<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo" style="color:#00a65a;">
    <b>Diagnóstico</b>Nutricional
  </div>
  <!-- User name -->
  <div class="lockscreen-name">Yliana Deza</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="../../images/foto.jpg" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->
    <form id="lockscreen" class="lockscreen-credentials">
    <!-- lockscreen credentials (contains the form) -->
      <div class="input-group">
        <input type="password" id="pass_lock" class="form-control" placeholder="contraseña">
        <div class="input-group-btn">
          <button class="btn"><i class="fa fa-arrow-right text-muted" onclick="unlock()"></i></button>
        </div>
      </div>
    </form>

  </div><!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Ingresa tu contraseña para retomar la sesión
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2016 <b><a href="http://softgroup-peru.com/">SoftGroup Perú</a></b><br>
     Todos los derechos reservados
  </div>
</div>
