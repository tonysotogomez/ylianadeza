      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Inicio
            <small>Menu Principal</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard active"></i> Inicio</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-number"><?php echo $cantidad[0]->totales;?> Alumnos</span>
                  <span class="info-box-text"><?php echo $cantidad[0]->hombres;?> Hombres</span>
                  <span class="info-box-text"><?php echo $cantidad[0]->mujeres;?> Mujeres</span>
                </div>
              </div>
            </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
        <!--        <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                  </div>
                </div> -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix visible-sm-block"></div>

              <div class="col-md-3 col-sm-6 col-xs-12">
            <!--    <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                  </div>
                </div>-->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
              <!--  <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
                  </div>
                </div>
              </div>-->
            </div>
          </div> <!-- end row -->
          <!-- Listado de aulas -->
          <div class="row">
          <section class="col-lg-7 connectedSortable">
                    <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Aulas</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Evaluaciones<br>Completas</th>
                            <th>Evaluaciones<br>Incompletas</th>
                            <th>Enlace</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                            $con = 1;
                            foreach ($aulas as $a) {
                              echo '<tr>';
                              echo '<td>'.$con.'</td>';
                              echo '<td>'.$a['nombre'].'</td>';
                              echo '<td>'.$a['evaluaciones'].'</td>';
                              echo '<td>'.$a['incompletas'].'</td>';
                              echo '<td><a href="'.$url.'examen/evaluacion/'.$a['id'].'"><button type="button" title="Ir al aula" class="btn btn-info btn-sm"><i class="fa fa-share-square-o"></i></button></a></td>';
                              echo '</tr>';
                              $con++;
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body
                    <div class="box-footer clearfix">
                      <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                      <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                    </div>
                    <!-- /.box-footer -->
                  </div>
          </section>

          <section class="col-lg-5 connectedSortable">
            <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Evaluaciones</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="text-center">
                <strong>Cantidad de evaluaciones totales / aulas</strong>
              </p>
              <?php
              foreach ($widget_2 as $w) {
                $porcentaje = $w->cantidad*100/$w->total;
                echo '<div class="col-sm-9">';
                echo '<div class="progress-group">';
                echo ' <span class="progress-text">Evaluación N°'.$w->numero.'</span>';
                echo '  <span class="progress-number"><b>'.$w->cantidad.'</b>/'.$w->total.' aulas</span>';
                echo '  <div class="progress sm">';
                echo '    <div class="progress-bar progress-bar-green" style="width: '.$porcentaje.'%"></div>';
                echo '  </div>';
                echo '</div></div>';
                echo '<div class="col-sm-3">';
                echo '<a href="'.$url.'examen/evaluacion/'.$w->numero.'"><button type="button" class="btn btn-default btn-sm" title="Descargar Excel">
                  <i class="fa fa-download"></i></button></a>';
                echo ' <a href="'.$url.'examen/evaluacion/'.$w->numero.'"><button type="button" class="btn btn-info btn-sm" title="Ir a la Evaluación '.$w->numero.'">
                    <i class="fa fa-share-square-o"></i></button></a>';
                echo '</div>';
              }



              ?>
              <!-- /.progress-group -->
            </div>
          </div>
        </section>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
