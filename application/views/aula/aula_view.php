<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Aulas
            <small>Mantenimiento</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Mantenimiento</a></li>
            <li class="active"><a href="#">Aulas</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Mantenimiento de Aulas<?php //echo $datos_aula[0]->aula; ?></h3>
                  <button type="button" class="btn btn-primary" onclick="Nuevo();"><i class="fa fa-user-plus"></i> Nuevo</button>
                  <input class="flat-red" type="checkbox" name="txt_todos" id="txt_todos" onclick="listar_todos();"> Listar todos
                </div><!-- /.box-header -->
                <input type="hidden" value="0>" id="todos">
                <div class="box-body">
                  <table id="t_aulas" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px;">Nro</th>
                        <th>Nombre</th>
                        <th>Observacion</th>
                        <th style="width: 150px;">Tipo</th>
                        <th style="width: 10px;">Estado</th>
                        <th style="width: 25px;">Editar</th>
                      </tr>
                    </thead>
                    <tbody id="tb_aulas">
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="width: 10px;">Nro</th>
                        <th>Nombre</th>
                        <th>Observacion</th>
                        <th style="width: 150px;">Tipo</th>
                        <th style="width: 10px;">Estado</th>
                        <th style="width: 25px;">Editar</th>
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
<?php $this->load->view('aula/form_aula'); ?>
