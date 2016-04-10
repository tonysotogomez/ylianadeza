<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $datos_aula[0]->titulo;?>
            <small><?php echo $datos_aula[0]->edades; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Aula</a></li>
            <li><?php echo $datos_aula[0]->titulo;?></li>
            <li class="active">Evaluaciones</li>
            <li class="active">Agregar Alumno</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Evaluación N° : </h3>
              <!--    <a href="<?php echo $url;?>reporte/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-info">
                    <i class="fa fa-line-chart"></i> Reporte
                  </button></a> -->
                  <a href="<?php echo $url;?>aula/index/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-warning pull-right">
                    <i class="fa fa-reply"></i> Regresar
                  </button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="<?php echo $url;?>examen/nuevoAlumno">
                    <input type="text" value="<?php echo $datos_aula[0]->id;?>" id="aula_id">
                    <input type="text" value="<?php echo $evaluacion[0]->id;?>" id="evaluacion_id">

                    Alumnos que no estuvieorn en la evaluación:
                    <select class="form-control" name="slct_estado" id="slct_estado">
                      <?php foreach ($alumnos_r as $a):
                        echo '<option value='.$a->id.'>'.$a->nombres.'</option>';
                      endforeach; ?>
                    </select>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<div id="msj" class="msjAlert"></div>
