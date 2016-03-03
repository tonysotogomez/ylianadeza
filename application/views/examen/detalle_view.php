<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <form id="form_datos" name="form_datos" action="" method="post">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Evaluación N°<?php echo $num; ?>:
            <?php echo $detalle[0]->evaluacion;?>
              <input type="hidden" name="txt_idEval" value="<?php echo $detalle[0]->idEvaluacion;?>">
            <small>Fecha Evaluación <?php echo  date('d-m-Y h:m:s', strtotime($detalle[0]->fecha)); ?></small>
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

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Detalle de evaluación</h3>

                  <a href="<?php echo $url;?>excel/detalle/<?php echo $detalle[0]->idEvaluacion;?>/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-default" title="Descargar Excel">
                      <i class="fa fa-download"></i> Evaluacion N°<?php echo $num; ?></button>
                  </a>
                  <a href="<?php echo $url;?>examen/evaluacion/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-warning pull-right">
                    <i class="fa fa-reply"></i> Regresar
                  </button></a>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="t_alumnos" class="table table-bordered table-striped">
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
                              echo '<td>'.$datos->diagnosticoF.'</td>';
                          echo '</tr>';
                          $con++;
                        }
                        ?>
                      </tbody>
                    </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        </form>
      </div><!-- /.content-wrapper -->
