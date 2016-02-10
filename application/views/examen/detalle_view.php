<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <form id="form_datos" name="form_datos" action="" method="post">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Evaluación N°<?php echo $num; ?>:
            <?php echo $detalle[0]->evaluacion;?>
              <input type="hidden" name="txt_idEval" value="<?php echo $detalle[0]->idEvaluacion;?>">
            <small>Fecha Evaluación <?php echo  $detalle[0]->fecha; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Aula</a></li>
            <li><?php echo $datos_aula[0]->titulo;?></li>
            <li>Evaluacion</li>
            <li class="active">Ver</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Detalle de evaluacion</h3>
                  <button type="button" class="btn btn-default" value="1" onclick="GuardarEvaluacion(1);"><i class="fa fa-download"></i> Descargar</button>
                  <a href="<?php echo $url;?>examen/evaluacion/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-warning pull-right">
                    <i class="fa fa-reply"></i> Regresar
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
                          <th>C. Talla</th>
                          <th>C. Peso</th>
                          <th>Observaciones</th>
                          <th>Talla Edad</th>
                          <th>Peso Edad</th>
                          <th>Peso Talla</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $con = 1;
                        $CI =& get_instance();
                        $CI->load->model("Edad_model","Edad");
                        foreach ($detalle as $datos) {
                          $edad = $CI->Edad->CargarEdad((float)$datos->edad);
                          $talla_creci = comparar($datos->talla_ant,$datos->talla);
                          $peso_creci = comparar($datos->peso_ant,$datos->peso);
                          echo '<tr>';
                              echo '<td>'.$con;
                              echo '<input type="hidden" class="form-control" name="txt_genero_'.$datos->idAlumno.'" value="'.$datos->genero.'">';
                              echo '<input type="hidden" class="form-control" name="txt_detalle_'.$datos->idAlumno.'" value="'.$datos->id.'">';
                              echo '<input type="hidden" class="form-control" name="txt_edad_'.$datos->idAlumno.'" value="'.$datos->edad.'">';
                              echo '</td>';
                              echo '<td>'.$datos->apellidos.'</td>';
                              echo '<td>'.$datos->nombres.'</td>';
                              echo '<td>'.$edad[0]->nombre.'</td>';
                              echo '<td>'.$datos->peso.'</td>';
                              echo '<td>'.$datos->talla.'</td>';
                              echo '<td>'.$datos->talla_ant.': '.$talla_creci.'</td>';
                              echo '<td>'.$datos->peso_ant.': '.$peso_creci.'</td>';
                              echo '<td>'.$datos->observaciones.'</td>';
                              echo '<td>'.diagnostico($datos->diagnosticoTE).'</td>';
                              echo '<td>'.diagnostico($datos->diagnosticoPE).'</td>';
                              echo '<td>'.diagnostico($datos->diagnosticoPT).'</td>';
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
                          <th>C. Talla</th>
                          <th>C. Peso</th>
                          <th>Observaciones</th>
                          <th>Talla Edad</th>
                          <th>Peso Edad</th>
                          <th>Peso Talla</th>
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
