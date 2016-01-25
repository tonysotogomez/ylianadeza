<!-- /.modal -->
<div class="modal fade" id="datosModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header logo">
                <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title">Datos</h4>
            </div>
            <div class="modal-body">
                <form id="form_datos" name="form_alumno" action="" method="post">
                    <div class="form-group">
                      <label for="peso">Peso</label>
                      <input type="text" class="form-control" name="txt_peso" placeholder="Ingrese el peso">
                    </div>

                    <div class="form-group">
                      <label for="talla">Talla</label>
                      <input type="text" class="form-control" name="txt_talla" placeholder="Ingrese la talla">
                    </div>

                    <input type="hidden" name="txt_id" id="txt_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="submit" class="btn btn-primary" value="0" onclick="AgregarEditarDatos(this.value)">Ingresar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
