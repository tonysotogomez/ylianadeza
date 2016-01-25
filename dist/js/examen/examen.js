$(document).ready(function() {

});

  function examen(){

        var datos=$("#form_examen").serialize().split("txt_").join("").split("slct_").join("");

        $.ajax({
            url         : url + 'examen/ejecutar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : datos,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(data) {
                $(".overlay,.loading-img").remove();
                $("#barra_talla_edad").html('<div class="progress-bar progress-bar-' + data.color + '" style="width: ' + data.porcentaje + '%"></div>');
                $("#talla_edad").html('<span class="badge bg-' + data.color + '">' + data.diagnostico + '</span>');

                $("#barra_peso_talla").html('<div class="progress-bar progress-bar-' + data.color2 + '" style="width: ' + data.porcentaje2 + '%"></div>');
                $("#peso_talla").html('<span class="badge bg-' + data.color2 + '">' + data.diagnostico2 + '</span>');

                $("#barra_peso_edad").html('<div class="progress-bar progress-bar-' + data.color3 + '" style="width: ' + data.porcentaje3 + '%"></div>');
                $("#peso_edad").html('<span class="badge bg-' + data.color3 + '">' + data.diagnostico3 + '</span>');


                $("#talla_edad_reglas").html(data.tabla1);
                $("#peso_talla_reglas").html(data.tabla2);
                $("#talla_peso_reglas").html(data.tabla3);
                /*
                if(data.rst==1){
                      $('#t_usuarios').dataTable().fnDestroy();
                      ListarUsuarios();
                      $('#usuarioModal .modal-footer [data-dismiss="modal"]').click();
                      mensaje('success', data.msj, 5000);
                  }
                  else{
                      $.each(obj.msj,function(index,datos){
                          mensaje('error', data.msj, 5000);
                      });
                  }
                  */
            }
        });
  }
