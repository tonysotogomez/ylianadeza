<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Perfil del Alumno
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Alumno</a></li>
            <li class="active">Diagnostico</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">
<?php
list($anio, $mes, $dia) = explode("-",$alumno[0]->fecha);
$mes = (int)$mes;
$dias = (int)$dia;
$f1=mktime(0,0,0,$mes,$dias,$anio);
$edad_s=time()-$f1;
$edad_a=$edad_s/(60*60*24*365);
$edad_m=($edad_a-(int)$edad_a)*12; //Multiplicamos la parte decimal de los años por 12 para obtener los meses.
$edad_d=($edad_m-(int)$edad_m)*24;//Multiplicamos la parte decimal de los meses por 24 para sacar los días.
$edad_meses=($edad_a)*12;//meses totales
//Luego debemos coger únicamente la parte entera de cada numero;
//$edad=(int)($edad_s/(60*60*24*365)); edad en años
$edad_a=(int)$edad_a; //Años
$edad_m=(int)$edad_m; //Meses
$edad_d=(int)$edad_d; //Dias

if($edad_a == 0) {
  $edad = $edad_m.' meses';
} elseif($edad_a > 0) {
  $edad = $edad_a.' años y '.$edad_m.' meses';
}
$meses_totales = (int)$edad_meses;
?>
              <!-- Profile Image -->
              <div class="box box-success">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo $url;?>images/image.jpg" alt="User profile">
                  <h3 class="profile-username text-center"><?php echo $alumno[0]->nombres.'<br>'.$alumno[0]->apellidos;?></h3>
                  <p class="text-muted text-center"><?php echo date('d-m-Y', strtotime( $alumno[0]->fecha));?></p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Edad</b> <a class="pull-right"><?php echo $edad;?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Peso</b> <a class="pull-right"><?php echo (isset($alumno[0]->peso))?$alumno[0]->peso:'No registrado';?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Talla</b> <a class="pull-right"><?php echo (isset($alumno[0]->talla))?$alumno[0]->talla:'No registrado';?></a>
                    </li>
                  </ul>

                  <a href="#" class="btn btn-danger btn-block"><b>Generar Reporte</b></a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Resultados</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i>  Peso para Edad</strong>
                  <p class="text-muted">
                    <?php echo (empty($historial))?'No se ha realizado ningun examen':$historial[0]->diagnosticoPE;?>
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Peso para Talla</strong>
                  <p class="text-muted">
                    <?php echo (empty($historial))?'No se ha realizado ningun examen':$historial[0]->diagnosticoPT;?>
                  </p>

                  <hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Talla para Edad</strong>
                  <p>
                    <?php echo (empty($historial))?'No se ha realizado ningun examen':$historial[0]->diagnosticoTE;?>
                  </p>

                  <hr>

                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Observación</strong>
                  <p><?php echo (empty($historial))?'Sin observaciones':$historial[0]->observaciones;?></p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#settings" data-toggle="tab">Examen</a></li>
                  <li><a href="#timeline" data-toggle="tab">Linea de Tiempo</a></li>
                </ul>
                <div class="tab-content">

                  <div class="active tab-pane" id="settings">
                    <?php echo form_open('alumno/examen','class="form-horizontal'); ?>
                      <input type="hidden" class="form-control" name="txtid" value="<?php echo $alumno[0]->id;?>">
                      <input type="hidden" class="form-control" name="txtedad" value="<?php echo $meses_totales;?>">
                      <input type="hidden" class="form-control" name="txtsexo" value="<?php echo $alumno[0]->genero;?>">
                      <div>
                        <p>Ultimo examen: <?php echo (empty($historial))?'No se ha realizado ningun examen':$historial[0]->fecha;?></p>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Edad</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="edad" value="<?php echo $edad; ?>" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Peso</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="txtpeso" placeholder="Peso" focus>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Talla</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="txttalla" placeholder="Talla">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Observacion</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="txtobservacion" placeholder="Comentarios"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                      </div>
                    <?php echo form_close(); ?>
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
