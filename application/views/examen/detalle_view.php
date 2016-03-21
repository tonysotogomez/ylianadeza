<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="tony">
      <form id="form_datos" name="form_datos" action="" method="post">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Evaluación N°<?php echo $num; ?>:
            <?php echo $detalle[0]->evaluacion;?>
              <input type="hidden" name="txt_idEval" value="<?php echo $detalle[0]->idEvaluacion;?>">
            <small>Fecha Evaluación <?php echo  date('d/m/Y - h:i A', strtotime($evaluacion[0]->fecha)); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Aula</a></li>
            <li><?php echo $datos_aula[0]->titulo;?></li>
            <li>Evaluación</li>
            <li class="active">Ver</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#detalle" data-toggle="tab">Detalle</a></li>
                  <li><a href="#reporte" data-toggle="tab">Reporte</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="detalle">
                    <div class="box-header">
                      <h2 class="page-header">
                        <i class="fa fa-file-text"></i> Detalle de evaluación
                        <a href="<?php echo $url;?>excel/detalle/<?php echo $detalle[0]->idEvaluacion;?>/<?php echo $datos_aula[0]->id;?>">
                          <button type="button" class="btn btn-default" title="Descargar Excel">
                            <i class="fa fa-download"></i> Evaluacion N°<?php echo $num; ?></button>
                        </a>
                        <a href="<?php echo $url;?>examen/evaluacion/<?php echo $datos_aula[0]->id;?>">
                          <button type="button" class="btn btn-warning pull-right">
                          <i class="fa fa-reply"></i> Regresar
                        </button></a>
                      </h2>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Nro</th>
                              <th>Apellidos y Nombres</th>
                              <th>Edad</th>
                              <th>Peso</th>
                              <th>G. Peso</th>
                              <th>Talla</th>
                              <th>G. Talla</th>
                              <th>Observaciones</th>
                              <th>Talla Edad</th>
                              <th>Peso Edad</th>
                              <th>Peso Talla</th>
                              <th>Diagnóstico Nutricional</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $con = 1;
                            $CI =& get_instance();
                            $CI->load->model("Edad_model","Edad");
                            foreach ($detalle as $datos) {
                              $edad = $CI->Edad->CargarEdad((float)$datos->edad);
                              $edad_texto = (empty($edad))?' ':$edad[0]->nombre;
                              $talla_creci = comparar($datos->talla_ant,$datos->talla);
                              $peso_creci = comparar($datos->peso_ant,$datos->peso);
                              echo '<tr>';
                                  echo '<td>'.$con;
                                  echo '</td>';
                                  echo '<td>'.$datos->apellidos.', '.$datos->nombres.'</td>';
                                  echo '<td>'.$edad_texto.'</td>';
                                  echo '<td>'.$datos->peso.' </td>';
                                  echo '<td>'.$peso_creci.'</td>';
                                  echo '<td>'.$datos->talla.'</td>';
                                  echo '<td>'.$talla_creci.'</td>';
                                  echo '<td>'.$datos->observaciones.'</td>';
                                  echo '<td>'.diagnostico($datos->diagnosticoTE).'</td>';
                                  echo '<td>'.diagnostico($datos->diagnosticoPE).'</td>';
                                  echo '<td>'.diagnostico($datos->diagnosticoPT).'</td>';
                                  echo '<td align="center"><b>'.diagnostico($datos->idDiagnostico).'</b></td>';
                              echo '</tr>';
                              $con++;
                            }
                            ?>
                          </tbody>
                        </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->


                  <div class="tab-pane" id="reporte">
                    <div class="box-header">
                      <h2 class="page-header">
                        <i class="fa fa-pie-chart"></i> Reporte de evaluación
                        <a href="<?php echo $url;?>excel/detalle/<?php echo $detalle[0]->idEvaluacion;?>/<?php echo $datos_aula[0]->id;?>">
                          <button type="button" class="btn btn-default" title="Descargar Excel">
                            <i class="fa fa-download"></i> Evaluacion N°<?php echo $num; ?></button>
                        </a>
                        <a href="<?php echo $url;?>examen/evaluacion/<?php echo $datos_aula[0]->id;?>">
                          <button type="button" class="btn btn-warning pull-right">
                          <i class="fa fa-reply"></i> Regresar
                        </button></a>
                      </h2>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-12 col-sm-6">
                          <dl class="dl-horizontal">
                            <dt>Nombre de Aula</dt>
                            <dd><?php echo $evaluacion[0]->aula;?></dd>
                            <dt>N° de Evaluación</dt>
                            <dd><?php echo $evaluacion[0]->numero;?></dd>
                            <dt>Nombre de Evaluación</dt>
                            <dd><?php echo $evaluacion[0]->nombre;?></dd>
                            <dt>Fecha de Evaluación</dd>
                            <dd><?php echo date('d/m/Y', strtotime($evaluacion[0]->fecha));?></dt>
                            <dt>Hora de Evaluación</dd>
                            <dd><?php echo date('H:i:s', strtotime($evaluacion[0]->fecha));?></dt>
                            <dt>Estado de Evaluación</dd>
                            <dd><?php
                            $completado = ($evaluacion[0]->completado==1)?'<span class="label label-success">Completa</span>':'<span class="label label-warning">Incompleta</span>';
                            echo $completado;?></dt>
                          </dl>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                          <dl class="dl-horizontal">
                            <dt>Cantidad de Alumnos</dd>
                            <dd><?php echo $evaluacion[0]->alumnos;?></dt>
                            <dt>Normal</dt>
                            <dd><?php echo $datos_num[0]->normales; ?></dd>
                            <dt>Obeso</dt>
                            <dd><?php echo $datos_num[0]->obesos; ?></dd>
                            <dt>Sobrepeso</dd>
                            <dd><?php echo $datos_num[0]->sobrepesos; ?></dt>
                            <dt>Desnutrición Aguda</dd>
                            <dd><?php echo $datos_num[0]->agudas; ?></dt>
                            <dt>Desnutrición Severa</dd>
                            <dd><?php echo $datos_num[0]->severos; ?></dt>
                            <dt>Desnutrición Crónica</dd>
                            <dd><?php echo $datos_num[0]->cronicos; ?></dt>
                          </dl>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                          <div id="pie_container"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                          <div id="bar_container"></div>
                        </div>
                      </div>
                    </div>
                </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->

              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </form>
    </div><!-- /.content-wrapper -->
