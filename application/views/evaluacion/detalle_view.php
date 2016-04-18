<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Evaluación N°<?php echo $num;?>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Evaluación</a></li>
            <li class="active">N°<?php echo $num;?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-3">

              <?php if(isset($completas)){ ?>
                <div class="box box-success">
                  <div class="box-header">
                    <h3 class="box-title">Evaluaciones Completas</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <?php
                    echo '<ol>';
                    foreach ($completas as $key) {
                			foreach ($key as $value) {
                				echo '<li><span class="text-green">'.$value->aula.'</span></li>';
                			}
                		}
                    echo '</ol>';
                    ?>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
                <?php }
                if(isset($incompletas)){
                ?>
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title">Evaluaciones Incompletas</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <?php
                    echo '<ol>';
                    foreach ($incompletas as $key) {
                      foreach ($key as $value) {
                        echo '<li><span class="text-orange">'.$value->aula.'</span></li>';
                      }
                    }
                    echo '</ol>';
                    ?>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
                <?php }
                if(isset($faltantes)){
                ?>
                <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Evaluaciones Faltantes</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <?php
                    echo '<ol>';
                    foreach ($faltantes as $key) {
                      foreach ($key as $value) {
                        echo '<li><span class="text-red">'.$value->titulo.'</span></li>';
                      }
                    }
                    echo '</ol>';
                    ?>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
                <?php }?>
            </div>

            <div class="col-xs-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Reporte</h3>
                  <a href="<?php echo $url;?>excel/reporte/<?php echo $num;?>">
                    <button type="button" class="btn btn-default" title="Descargar Excel" disabled>
                      <i class="fa fa-download"></i> Descargar</button>
                  </a>
                </div><!-- /.box-header -->
                <div class="box-body">

                  <?php
                  $con = 1; $t_normales = 0; $t_obesos = 0; $t_sobrepesos = 0;
                  $t_agudas = 0; $t_severos = 0; $t_cronicos= 0; $t_totales= 0;
                  echo '<div class="box-body no-padding">
                          <table class="table table-condensed">
                            <tbody><tr>
                              <th style="width: 10px">#</th>
                              <th>Aula</th>
                              <th>Normal</th>
                              <th style="width: 40px">Obeso</th>
                              <th>Sobrepeso</th>
                              <th>Desnutrición Aguda</th>
                              <th>Desnutrición Severa</th>
                              <th>Desnutrición Crónica</th>
                              <th>Total</th>
                            </tr>';
                  foreach ($aulas as $key) {
                    echo '<tr>';
                    foreach ($key as $value) {
                      $normales = ($value->normales>0)?'<span class="badge bg-blue">'.$value->normales.'<span>':'0';
                      $obesos = ($value->obesos>0)?'<span class="badge bg-yellow">'.$value->obesos.'<span>':'0';
                      $sobrepesos = ($value->sobrepesos>0)?'<span class="badge bg-yellow">'.$value->sobrepesos.'<span>':'0';
                      $agudas = ($value->agudas>0)?'<span class="badge bg-red">'.$value->agudas.'<span>':'0';
                      $severos = ($value->severos>0)?'<span class="badge bg-red">'.$value->severos.'<span>':'0';
                      $cronicos = ($value->cronicos>0)?'<span class="badge bg-red">'.$value->cronicos.'<span>':'0';


                      echo '<td>'.$con.'</td>';
                      echo '<td>'.$value->aula.'</td>';
                      echo '<td align="center">'.$normales.'</td>';
                      echo '<td align="center">'.$obesos.'</td>';
                      echo '<td align="center">'.$sobrepesos.'</td>';
                      echo '<td align="center">'.$agudas.'</td>';
                      echo '<td align="center">'.$severos.'</td>';
                      echo '<td align="center">'.$cronicos.'</td>';
                      echo '<td align="center"><span class="badge bg-gray">'.$value->totales.'</span></td>';

                      $t_normales += $value->normales;
                      $t_obesos += $value->obesos;
                      $t_sobrepesos += $value->sobrepesos;
                      $t_agudas += $value->agudas;
                      $t_severos += $value->severos;
                      $t_cronicos += $value->cronicos;
                      $t_totales += $value->totales;
                      $con++;
                    }
                    echo '</tr>';
                  }//end foreach
                  echo '</tbody>';
                  echo '<tfooter align="center">';
                  echo "<th style='width: 10px'> </th>
                  <th>Totales</th>
                  <td align='center'><span class='badge bg-blue'>$t_normales<span></td>
                  <td align='center' style='width: 40px'><span class='badge bg-yellow'>$t_obesos<span></td>
                  <td align='center'><span class='badge bg-yellow'>$t_sobrepesos<span></td>
                  <td align='center'><span class='badge bg-red'>$t_agudas<span></td>
                  <td align='center'><span class='badge bg-red'>$t_severos<span></td>
                  <td align='center'><span class='badge bg-red'>$t_cronicos<span></td>
                  <td align='center'><span class='badge bg-gray'>$t_totales<span></td></tfooter>
                  </table></div>";
                  ?>

                </div><!-- /.box-body -->
            </div>

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
