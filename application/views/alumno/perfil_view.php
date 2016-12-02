<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Perfil del Alumno
            <button type="button" class="btn btn-warning" onclick="history.back();">
              <i class="fa fa-reply"></i> Regresar
            </button>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Alumno</a></li>
            <li class="active">Perfil</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3">
              <?php
              $edad = calcular_edad($alumno[0]->fecha_nacimiento);
              ?>
              <!-- Profile Image -->
              <div class="col-md-6 col-lg-12">
                <div class="box box-success">
                  <div class="box-body box-profile">
                    <?php
                    switch ($alumno[0]->genero) {
                      case 'h': $foto = 'boy.png';
                        break;
                      case 'm': $foto = 'girl.png';
                        break;
                      default: $foto = 'image.jpg';
                        break;
                    }
                    ?>
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $url.'images/'.$foto;?>" alt="User profile">
                    <h3 class="profile-username text-center"><?php echo $alumno[0]->nombres.'<br>'.$alumno[0]->apellidos;?></h3>
                    <p class="text-muted text-center"><?php echo date('d-m-Y', strtotime( $alumno[0]->fecha_nacimiento)).' ('.$edad.')';?></p>

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Edad</b> (Ult. Eval) <a class="pull-right"><?php echo (isset($alumno[0]->edad))?traducir_edad($alumno[0]->edad):'No registrado';?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Peso</b> (Ult. Eval) <a class="pull-right"><?php echo (isset($alumno[0]->peso))?$alumno[0]->peso:'No registrado';?> kg</a>
                      </li>
                      <li class="list-group-item">
                        <b>Talla</b> (Ult. Evaln) <a class="pull-right"><?php echo (isset($alumno[0]->talla))?$alumno[0]->talla:'No registrado';?> cm</a>
                      </li>
                    </ul>

                    <a href="<?php echo $url;?>excel/reporteAlumno/<?php echo $alumno[0]->id;?>" class="btn btn-danger btn-block"><b>Generar Reporte</b></a>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div>
              <!-- About Me Box -->
              <div class="col-md-6 col-lg-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Resultados</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i>  Peso para Edad</strong>
                    <p class="pull-right ext-muted">
                      <?php echo (empty($evaluaciones))?'No se ha realizado ningún examen':diagnostico($evaluaciones[0]->diagnosticoPE);?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Peso para Talla</strong>
                    <p class="pull-right text-muted">
                      <?php echo (empty($evaluaciones))?'No se ha realizado ningún examen':diagnostico($evaluaciones[0]->diagnosticoPT);?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Talla para Edad</strong>
                    <p class="pull-right text-muted">
                      <?php echo (empty($evaluaciones))?'No se ha realizado ningún examen':diagnostico($evaluaciones[0]->diagnosticoTE);?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Observación</strong>
                    <p><?php echo (empty($evaluaciones))?'Sin observaciones':$evaluaciones[0]->observaciones;?></p>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div>
            </div><!-- /.col -->
            <div class="col-sm-12 col-md-12 col-lg-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#evaluaciones" data-toggle="tab">Evaluaciones</a></li>
                  <li><a href="#estadisticas" data-toggle="tab">Estadísticas</a></li>
                  <!-- <li><a href="#timeline" data-toggle="tab">Linea de Tiempo</a></li> -->
                </ul>
                <div class="tab-content">

                  <div class="active tab-pane" id="evaluaciones">
                    <div class="box-body">
                      <div class="row">
                        <input type="hidden" class="form-control" name="txtid" value="<?php echo $alumno[0]->id;?>">
                        <input type="hidden" class="form-control" name="txtedad" value="<?php echo $edad;?>">
                        <input type="hidden" class="form-control" name="txtsexo" value="<?php echo $alumno[0]->genero;?>">
                        <div>
                          <?php
                            if(empty($evaluaciones)) $fecha = 'No se ha realizado ningun examen';
                            else {
                              $ult_eval = end($evaluaciones);
                              $fecha = $ult_eval->fecha;
                            }
                          ?>
                          <p>Ultimo examen: <b><?php echo $fecha;?></b></p>
                          <div class="box-body table-responsive no-padding">
                            <table class="table table-striped">
                              <tbody>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Evaluacion</th>
                                  <th>Fecha</th>
                                  <th>Edad</th>
                                  <th>Peso</th>
                                  <th>Talla</th>
                                  <th>T/E</th>
                                  <th>P/E</th>
                                  <th>P/T</th>
                                  <th>Diagnóstico</th>
                                </tr>
                                <?php foreach ($evaluaciones as $e) { ?>
                                  <tr>
                                    <td><?=$e->num?></td>
                                    <td><?=$e->evaluacion?></td>
                                    <td><?=$e->fecha?></td>
                                    <td><?=traducir_edad($e->edad)?></td>
                                    <td><?=$e->peso?></td>
                                    <td><?=$e->talla?></td>
                                    <td><?=$e->diagnosticoTE?></td>
                                    <td><?=$e->diagnosticoPE?></td>
                                    <td><?=$e->diagnosticoPT?></td>
                                    <td><b><?=diagnostico($e->diagnostico)?></b></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div><!-- /.tab-pane -->


                  <div class="tab-pane" id="estadisticas">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                          <div  class="contains-chart" id="talla_line_container"></div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-lg-6">
                          <div  class="contains-chart" id="peso_line_container"></div>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs">Read more</a>
                            <a class="btn btn-danger btn-xs">Delete</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                          <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-comments bg-yellow"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-camera bg-purple"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                          <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
