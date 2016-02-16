$(document).ready(function() {
  ListarAlumnos();
  $("#t_evaluaciones").dataTable();
});

  function examen(){

      var gender = $("input[type='radio'][name='txt_genero']:checked").val();
      var cond = (gender == 'h')?'45.1':'45';
      if($("#talla").val() >= cond){
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
            },
            error : function(){
              $(".overlay,.loading-img").remove();
                $("#msj").html('<div class="alert alert-dismissable alert-danger">'+
                                        '<i class="fa fa-ban"></i>'+
                                        '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                        ' <b>Ocurrio un error en el proceso, posible causa: Valores ingresados no tienen lógica</b>'+
                                    '</div>');
            }
        });
      } else {
        var genero = (gender == 'h')?'hombres':'mujeres';
        mensaje('warning', 'La talla minima de '+genero +' es de '+cond+' cm.', 5000);
      }//end if
  }


  function Cargar(id){
    $('#datosModal').modal('show');
    $('#datosModal').find('.modal-title').text('Peso y Talla');
    $('#submit').text('Ingresar');
    var idAula = $('#aula_id').val();
        $.ajax({
            url         : url + "alumno/cargar",
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : {id: id, idAula: idAula},
            success : function(data) {
                var alumno = data['alumno'][0];
                var nac = alumno['fecha'].split("-");
                $("#txt_id").val(alumno['id']);
                $("#txt_fecha").val(nac[2]+"-"+nac[1]+"-"+nac[0]);
            }
        });
  }
  //listado de alumnos resumida para el examen
    function ListarAlumnos(){
      var id = $('#aula_id').val();
      $.ajax({
            url         : url + 'aula/listar2',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : {id: id},
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    HTMLCargarAlumno(obj.listado);
                }
                $(".overlay,.loading-img").remove();
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
            }
        });
    }

    function HTMLCargarAlumno(datos){
      var html="";
      var con = 0;
      var edadf, genero, nombres, estadohtml;
      $('#t_alumnos').dataTable().fnDestroy();

      $.each(datos,function(index,data){
          con++;
          var edadf = carcularEdad(data.fecha_nacimiento);

          if(data.nombres != null) nombres = data.nombres;
          else nombres = "No registrado";

          if(data.apellidos != null) apellidos = data.apellidos;
          else apellidos = "No registrado";

          html+="<tr>"+
              "<td>"+con+"</td>"+
              "<td>"+apellidos+"</td>"+
              "<td>"+nombres+"</td>"+
              "<td>"+edadf+"</td>"+
              '<td><input type="text" class="form-control" name="txt_peso_'+data.id+'" placeholder="Ingrese el peso"></td>'+
              '<td><input type="text" class="form-control" name="txt_talla_'+data.id+'" placeholder="Ingrese el talla"></td>'+
              '<td><input type="text" class="form-control" name="txt_observaciones_'+data.id+'" placeholder="Observaciones">'+
              '<input type="hidden" value="'+data.fecha_nacimiento+'" name="txt_fecha_'+data.id+'">'+
              '<input type="hidden" value="'+data.genero+'" name="txt_genero_'+data.id+'"></td>'+
              '<td>'+data.fecha_nacimiento+'</td>';
          html+="</tr>";
      });
      $("#tb_alumnos").html(html);
      $("#t_alumnos").dataTable({
          "bStateSave": true,
          "responsive": true,
          "paging": false,
          "lengthChange": true,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Ãšltimo",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
          }
      });
    }


    function GuardarEvaluacion(AE){
          var datos=$("#form_datos").serialize().split("txt_").join("");

          var accion="examen/insertarDetalle";
          if(AE==1){
              accion="examen/editarDetalle";
          }
          $.ajax({
              url         : url + accion,
              type        : 'POST',
              cache       : false,
              dataType    : 'json',
              data        : datos,
              beforeSend : function() {
                  $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
              },
              success : function(data) {
                  $(".overlay,.loading-img").remove();
                  if(data.rst==1){
                      $('#t_alumnos').dataTable().fnDestroy();
                      ListarAlumnos();
                      window.location.replace(url + "examen/evaluacion/"+data.aula);
                      //mensaje('success', data.msj, 5000)

                    }
                  else{
                      mensaje('error', data.msj, 5000);
                  }
              }
          });
    }

    function EliminarEvaluacion(id){
      if (confirm('¿Estas seguro de eliminar la Evaluación?')){
          $.ajax({
              url         : url + "examen/eliminar",
              type        : 'POST',
              cache       : false,
              dataType    : 'json',
              data        : {id: id},
              success : function(data) {
                if(data.rst==1){
                    location.reload();
                  }
                else{
                    mensaje('error', data.msj, 5000);
                }
              }
          });
       }
    }
