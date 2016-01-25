<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Diagnostico Nutricional
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Examen</a></li>
            <li class="active">Diagnostico</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header with-boder">
                  <h3 class="box-title">Ingreses los datos</h3>
                </div>

                <div class="box-body">
                  <form id="form_examen" name="form_examen" class="form-horizontal" action="" method="post">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Edad</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="txt_edad" placeholder="Formato 1.01 = 1 año 1 mes"
                          value="<?php echo (isset($edad))?$edad:'0';?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Peso</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="txt_peso" placeholder="Peso"
                          value="<?php echo (isset($peso))?$peso:'4.070';?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Talla</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="txt_talla" placeholder="Talla"
                          value="<?php echo (isset($talla))?$talla:'50.5';?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Género:</label>
                        <div class="col-sm-2">
                            &nbsp;
                        </div>
                        <div class="col-sm-4">
                            <input type="radio" name="txt_genero" value="h" checked> Hombre
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="txt_genero" value="m"> Mujer
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button" onclick="examen()" class="btn btn-primary">Examinar</button>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
            </div><!-- /.col -->
              <div class="col-md-6">
                  <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Resultados</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <table class="table table-striped" id="t_resultado">
                      <thead>
                        <tr>
                          <th>Concepto</th>
                          <th style="width: 140px"></th>
                          <th style="width: 40px">Label</th>
                        </tr>
                      </thead>
                      <tbody id="tb_resultado">
                      <tr>
                        <td>Peso para Edad</td>
                        <td>
                          <div class="progress progress-xs progress-striped active" id="barra_peso_edad">

                          </div>
                        </td>
                        <td><span id="peso_edad"></span></td>
                      </tr>
                      <tr>
                        <td>Peso para Talla</td>
                        <td>
                          <div class="progress progress-xs progress-striped active" id="barra_peso_talla">

                          </div>
                        </td>
                        <td><span id="peso_talla"></span></td>
                      </tr>
                      <tr>
                        <td>Talla para Edad</td>
                        <td>
                          <div class="progress progress-xs progress-striped active" id="barra_talla_edad">

                          </div>
                        </td>
                        <td><span id="talla_edad"></span></td>
                      </tr>
                    </tbody></table>
                  </div><!-- /.box-body -->
                </div>
              </div>

              <div class="col-md-6">
                  <div class="box box-info">
                  <div class="box-header">
                    <h3 class="box-title" id="talla_edad_titulo">Talla para la edad</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <table class="table table-hover">
                    	<thead>
                        <tr>
                    	     <th>Edad</th><th>Meses</th><th>-3 DE</th><th>-2 DE</th><th>-1 DE</th><th>Mediana</th><th>1 DE</th><th>2 DE</th><th>3 DE</th>
                    	  </tr>
                      </thead>
                      <tbody id="talla_edad_reglas">
                      </tbody>
                    </table>
                  </div><!-- /.box-body -->
                </div>
              </div>

              <div class="col-md-6">
                  <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title" id="peso_talla_titulo">Peso para la Talla</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                           <th>cm</th><th>-3 DE</th><th>-2 DE</th><th>-1 DE</th><th>Mediana</th><th>1 DE</th><th>2 DE</th><th>3 DE</th>
                        </tr>
                      </thead>
                      <tbody id="peso_talla_reglas">
                      </tbody>
                    </table>
                  </div><!-- /.box-body -->
                </div>
              </div>

              <div class="col-md-6">
                  <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title" id="talla_peso_titulo">Peso para la edad</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                           <th>Edad</th><th>Meses</th><th>-3 DE</th><th>-2 DE</th><th>-1 DE</th><th>Mediana</th><th>1 DE</th><th>2 DE</th><th>3 DE</th>
                        </tr>
                      </thead>
                      <tbody id="talla_peso_reglas">
                      </tbody>
                    </table>
                  </div><!-- /.box-body -->
                </div>
              </div>
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
