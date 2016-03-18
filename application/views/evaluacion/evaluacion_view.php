<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Evaluaciones
            <small>asdf</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Evaluaciones</a></li>
            <li class="active">Listado</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Listado de Evaluaciones</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="t_evaluaciones" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px;">Evaluación</th>
                        <th style="width: 100px;">Ultima Evaluación</th>
                        <th style="width: 100px;">Aulas</th>
                        <th style="width: 10px;">Total Aulas</th>
                        <th style="width: 25px;">Opciones</th>
                      </tr>
                    </thead>
                    <tbody id="tb_evaluaciones">
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="width: 10px;">Evaluación</th>
                        <th style="width: 100px;">Ultima Evaluación</th>
                        <th style="width: 100px;">Aulas</th>
                        <th style="width: 10px;">Total Aulas</th>
                        <th style="width: 25px;">Opciones</th>
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
<?php //$this->load->view('alumno/form_alumno'); ?>
