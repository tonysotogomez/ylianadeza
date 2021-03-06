<!-- /.modal -->
<div class="modal fade" id="alumnoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header logo">
                <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title">Usuario</h4>
            </div>
            <form id="form_alumno" name="form_alumno" action="" method="post">
              <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" name="txt_apellidos" id="txt_apellidos" placeholder="Ingresa sus apellidos" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control" name="txt_nombres" id="txt_nombres" placeholder="Ingresa sus nombres" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="dni">DNI:</label>
                        <input type="text" class="form-control" name="txt_dni" id="txt_dni" placeholder="Ingresa su DNI">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="titular">Titular:</label>
                        <input type="text" class="form-control" name="txt_titular" id="txt_titular" placeholder="Ingresa el titular">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Fecha de Nacimiento:</label>
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          <input type="text" class="form-control" id="txt_fecha" name="txt_fecha" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required>
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="radio">
                          <label>
                            <input type="radio" name="radiogenero" value="h" checked> Hombre <br>
                            <input type="radio" name="radiogenero" value="m"> Mujer
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Aula: </label>
                          <select class="form-control" name="slct_aula" id="slct_aula">
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Estado:
                            </label>
                            <select class="form-control" name="slct_estado" id="slct_estado">
                                <option value='0'>Inactivo</option>
                                <option value='1' selected>Activo</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="txt_id" id="txt_id">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" id="submit" class="btn btn-primary" value="0">Guardar</button>
              </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
