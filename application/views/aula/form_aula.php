<!-- /.modal -->
<div class="modal fade" id="aulaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header logo">
                <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title">Aula</h4>
            </div>
            <div class="modal-body">
                <form id="form_aula" name="form_aula" action="" method="post">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nombre:</label>
                        <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" placeholder="Ingresa el nombre">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Descripción:</label>
                        <input type="text" class="form-control" name="txt_descripcion" id="txt_descripcion" placeholder="Ingresa una descripcion">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tipo:</label>
                        <select class="form-control" name="slct_tipo" id="slct_tipo">
                            <option value='0'>Seleccione</option>
                            <option value='1' selected>Andantes</option>
                            <option value='2' selected>Andantes</option>
                            <option value='3' selected>Infantes</option>
                            <option value='4' selected>Jardín</option>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="submit" class="btn btn-primary" value="0" onclick="AgregarEditar(this.value)">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
