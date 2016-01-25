<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Nuevo Alumno
      <small>No hay validacion de campos asi que los datos deben ser 100% identicos a las hojas</small>

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Alumno</a></li>
      <li class="active">Nuevo</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

<?php echo form_open('alumno/guardar'); ?>
  <div class="row">
      <div class="col-md-6">
        <div class="box box-success">

            <div class="box-header with-boder">
              <h3 class="box-title">Datos Básicos</h3>
            </div>

            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nro:</label>
                <input type="text" class="form-control" name="txtnro" placeholder="Ingrese su N° de Alumno">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Apellidos:</label>
                <input type="text" class="form-control" name="txtapellidos" placeholder="Ingresa sus apellidos">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Nombres:</label>
                <input type="text" class="form-control" name="txtnombres" placeholder="Ingresa sus nombres">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Titular:</label>
                <input type="text" class="form-control" name="txttitular" placeholder="Ingresa el titular">
              </div>

              <div class="form-group">
                <div class="radio">
                  <label>
                    <input type="radio" name="radiogenero" value="h" checked> Hombre <br>
                    <input type="radio" name="radiogenero" value="m"> Mujer
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label>Fecha de Nacimiento:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control" name="txtfecha" id="datemask" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                </div><!-- /.input group -->
              </div><!-- /.form group -->

            <div class="form-group">
              <label>Aula: </label>
              <select class="form-control" name="slctaula">
                <?php foreach($aulas as $fila) {
                  echo '<option value="'.$fila->id.'">'.$fila->nombre.'</option>';
                 } ?>
              </select>
            </div>

            </div><!-- /.box-body -->
          </div><!-- /.box -->
      </div>

      <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <br>
        <?php echo (isset($msj))?$msj:''; ?>
      </div>

  </div>
  <?php echo form_close(); ?>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
