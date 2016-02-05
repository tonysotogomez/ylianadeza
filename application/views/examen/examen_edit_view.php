<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <form id="form_datos" name="form_datos" action="" method="post">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Evaluación N°<?php //echo $count_eval+1; ?>:
            <input type="text" name="txt_titulo"
              placeholder="Nombre de Evaluacion" value="<?php echo $detalle[0]->evaluacion;?>">
              <input type="hidden" name="txt_idEval" value="<?php echo $detalle[0]->idEvaluacion;?>">
            <small>Fecha Evaluación <?php echo  $detalle[0]->fecha; ?></small>
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
                  <h3 class="box-title">La evaluación se actualizará cuando de clic en el botón Guardar</h3>
                  <button type="button" class="btn btn-primary" value="1" onclick="GuardarEvaluacion(1);"><i class="fa fa-save"></i> Editar</button>
                  <a href="<?php echo $url;?>examen/evaluacion/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-danger pull-right">
                    <i class="fa fa-remove"></i> Cancelar
                  </button></a>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <input type="hidden" value="<?php echo date("Y-m-d");?>" name="txt_fecha_eval">
                    <input type="hidden" value="<?php echo $datos_aula[0]->id;?>" name="txt_aula" id="aula_id">
                    <table id="t_alumnos" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Nro</th>
                          <th>Apellidos</th>
                          <th>Nombres</th>
                          <th>Edad</th>
                          <th>Peso</th>
                          <th>Talla</th>
                          <th>Obervaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $con = 1;
                        foreach ($detalle as $datos) {
                          echo '<tr>';
                              echo '<td>'.$con.'</td>';
                              echo '<td>'.$datos->apellidos.'</td>';
                              echo '<td>'.$datos->nombres.'</td>';
                              echo '<td><input type="hidden" class="form-control" name="txt_detalle_'.$datos->idAlumno.'" value="'.$datos->id.'"><input type="text" class="form-control" name="txt_peso_'.$datos->idAlumno.'" value="'.$datos->edad.'"></td>';
                              echo '<td><input type="text" class="form-control" name="txt_peso_'.$datos->idAlumno.'" value="'.$datos->peso.'"></td>';
                              echo '<td><input type="text" class="form-control" name="txt_talla_'.$datos->idAlumno.'" value="'.$datos->talla.'"></td>';
                              echo '<td><input type="text" class="form-control" name="txt_observaciones_'.$datos->idAlumno.'" value="'.$datos->observaciones.'"></td>';
                          echo '</tr>';
                          $con++;
                        }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Nro</th>
                          <th>Apellidos</th>
                          <th>Nombres</th>
                          <th>Edad</th>
                          <th>Peso</th>
                          <th>Talla</th>
                          <th>Obervaciones</th>
                        </tr>
                      </tfoot>
                    </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        </form>
      </div><!-- /.content-wrapper -->
<div id="msj" class="msjAlert"></div>
<?php $this->load->view('alumno/form_alumno'); ?>
