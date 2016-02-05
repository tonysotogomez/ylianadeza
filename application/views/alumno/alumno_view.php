<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $datos_aula[0]->titulo;?>
            <small><?php echo $datos_aula[0]->edades; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Aula</a></li>
            <li class="active"><?php echo $datos_aula[0]->titulo;?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Nómina de Niños<?php //echo $datos_aula[0]->aula; ?></h3>
                  <button type="button" class="btn btn-primary" onclick="Nuevo();"><i class="fa fa-user-plus"></i> Nuevo</button>
                  <a href="<?php echo $url;?>examen/evaluacion/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-warning">
                      <i class="fa fa-heartbeat"></i> Evaluaciones</button>
                  </a>
                  <a href="<?php echo $url;?>excel/listado/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-default">
                      <i class="fa fa-download"></i> Descargar</button>
                  </a>
                </div><!-- /.box-header -->
                <input type="hidden" value="<?php echo $datos_aula[0]->id;?>" id="aula_id">
                <div class="box-body">
                  <table id="t_alumnos" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th align="center">Sexo</th>
                        <th>Fecha Nacimiento</th>
                        <th style="width: 307px;">Titular</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody id="tb_alumnos">
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nro</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Sexo</th>
                        <th>Fecha Nacimiento</th>
                        <th style="width: 307px;">Titular</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<div id="msj" class="msjAlert"></div>
<?php $this->load->view('alumno/form_alumno'); ?>
