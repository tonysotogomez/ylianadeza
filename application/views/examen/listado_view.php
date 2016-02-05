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
            <li class="active"><?php echo $datos_aula[0]->titulo;?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Listado de Evaluaciones</h3>
                  <a href="<?php echo $url;?>examen/nuevoDetalle/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> Nueva Evaluación
                  </button></a>
                  <a href="<?php echo $url;?>aula/index/<?php echo $datos_aula[0]->id;?>">
                    <button type="button" class="btn btn-danger">
                    <i class="fa fa-reply"></i> Regresar
                  </button></a>
                </div><!-- /.box-header -->
                <input type="hidden" value="<?php echo $datos_aula[0]->id;?>" id="aula_id">
                <div class="box-body">
                  <table id="t_evaluaciones" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody id="tb_evaluaciones">
                      <?php
                        $con = 1;
                        foreach ($evaluaciones as $eval) {
                          $estadohtml='<span id="'.$eval->id.'" onClick="CambiarEstadoEval('.$eval->id.','.$eval->estado.')" class="btn btn-danger btn-sm">Inactivo</span>';
                          if($eval->estado==1){
                              $estadohtml='<span id="'.$eval->id.'" onClick="CambiarEstadoEval('.$eval->id.','.$eval->estado.')" class="btn btn-success btn-sm">Activo</span>';
                          }

                          echo '<tr>';
                          echo '<td>'.$con.'</td>';
                          echo '<td>'.$eval->nombre.'</td>';
                          echo '<td>'.date('d-m-Y', strtotime($eval->fecha)).'</td>';
                          echo '<td>'.$eval->observacion.'</td>';
                          echo '<td><a href="'.$url.'examen/cargarDetalle/'.$eval->id.'/'.$datos_aula[0]->id.'"><button type="button" title="Editar" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editar</button></a>';
                          echo ' <button type="button" title="Eliminar" class="btn btn-sm btn-danger" onClick="EliminarEvaluacion('.$eval->id.')"><i class="fa fa-trash"></i> Eliminar</button></td>';
                          echo '</tr>';
                          $con++;
                        }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<div id="msj" class="msjAlert"></div>
