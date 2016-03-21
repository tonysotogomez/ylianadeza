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

                <div class="box box-success">
                  <div class="box-header">
                    <h3 class="box-title">Evaluaciones Completas</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <?php
                    echo '<ol>';
                    foreach ($reporte as $key) {
                			foreach ($key as $value) {
                				echo '<li><span class="text-green">'.$value->aula.'</span></li>';
                			}
                		}
                    echo '</ol>';
                    ?>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->

                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title">Evaluaciones Incompletas</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <?php
                    echo '<ol>';
                    foreach ($reporte2 as $key) {
                      foreach ($key as $value) {
                        echo '<li><span class="text-orange">'.$value->aula.'</span></li>';
                      }
                    }
                    echo '</ol>';
                    ?>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->

                <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Evaluaciones Faltantes</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <?php
                    echo '<ol>';
                    foreach ($reporte3 as $key) {
                      foreach ($key as $value) {
                        echo '<li><span class="text-red">'.$value->titulo.'</span></li>';
                      }
                    }
                    echo '</ol>';
                    ?>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div>

            <div class="col-xs-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Reporte</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                  <?php
                  $con = 1;
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
                      $con++;
                    }
                    echo '</tr>';
                  }
                  echo '</tbody></table></div>';
                  ?>

                </div><!-- /.box-body -->
            </div>

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
