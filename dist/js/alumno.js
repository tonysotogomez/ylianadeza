$(document).ready(function() {
  ListarAlumnos();
  $('#alumnoModal').on('shown.bs.modal', function(e){
    $.ajax({
        url         : url + "aula/listado_select",
        type        : 'POST',
        cache       : false,
        dataType    : 'json',
        success : function(data) {
            var i, len, selected = '', opciones = '';
            var aulas = data['aulas'];
            var id = $('#aula_id').val();
            for (i = 0, len = data['aulas'].length; i < len; i++) {
              if (id == aulas[i]['id']) { selected = 'selected'; }
              else { selected = ''; }
              opciones += '<option value="'+aulas[i]['id']+'" '+selected+'>'+aulas[i]['nombre']+'</option>';
            }
            $('#slct_aula').append(opciones);
        }
    });
  });

});


function Nuevo(){
  $("#txt_apellidos").val('');
  $("#txt_nombres").val('');
  $("#txt_titular").val('');
  $('input[name="radiogenero"][value="h"]').prop('checked', true);
  $("#txt_fecha").val('');
  $("#slct_estado").val('1');
  $('#alumnoModal').find('.modal-title').text('Nuevo Alumno');
  $('#alumnoModal').modal('show');
}


  function ListarAlumnos(){
    var id = $('#aula_id').val();
    $.ajax({
          url         : url + 'aula/listar',
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
    var fecha, genero, nombres, estadohtml;
    $('#t_alumnos').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        con++;
        if(data.fecha_nacimiento != null){
          var nac = (data.fecha_nacimiento).split("-");
          fecha = nac[2]+"-"+nac[1]+"-"+nac[0];
        } else fecha = "No registrado";

        if(data.genero != null) genero = data.genero.toUpperCase();
        else genero = "No registrado";

        if(data.nombres != null) nombres = data.nombres;
        else nombres = "No registrado";

        estadohtml='<span id="'+data.id+'" onClick="CambiarEstado('+data.id+','+data.estado+')" class="btn btn-danger btn-sm">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.id+'" onClick="CambiarEstado('+data.id+','+data.estado+')" class="btn btn-success btn-sm">Activo</span>';
        }
        html+="<tr>"+
            "<td>"+con+"</td>"+
            "<td>"+data.apellidos+"</td>"+
            "<td>"+nombres+"</td>"+
            "<td>"+genero+"</td>"+
            "<td>"+fecha+"</td>"+
            "<td>"+data.titular+"</td>"+
            "<td>"+estadohtml+"</td>"+
            '<td><button type="button" title="Editar" onclick="Cargar('+data.id+')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>'+
            ' <a href="'+url+'alumno/perfil/'+data.id+'"><button title="Historial" type="button" class="btn btn-sm btn-info"><i class="fa fa-area-chart"></i></button></a></td>';
        html+="</tr>";
    });
    $("#tb_alumnos").html(html);
    $("#t_alumnos").dataTable({
       "bStateSave": true,
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
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


  function AgregarEditar(AE){
        var datos=$("#form_alumno").serialize().split("txt_").join("").split("slct_").join("");
        var accion="alumno/crear";
        if(AE==1){
            accion="alumno/editar";
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
                      $('#alumnoModal .modal-footer [data-dismiss="modal"]').click();
                      mensaje('success', data.msj, 5000);
                  }
                  else{
                      $.each(obj.msj,function(index,datos){
                          mensaje('error', data.msj, 5000);
                      });
                  }
            }
        });
  }

  function Cargar(id){
    $('#alumnoModal').modal('show');
    $('#alumnoModal').find('.modal-title').text('Editar Alumno');
    $('#submit').text('Editar');
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
                $("#txt_apellidos").val(alumno['apellidos']);
                $("#txt_nombres").val(alumno['nombres']);
                $("#txt_titular").val(alumno['titular']);
                $('input[name="radiogenero"][value="' + alumno['genero'] + '"]').prop('checked', true);
                $("#txt_fecha").val(nac[2]+"-"+nac[1]+"-"+nac[0]);
                $("#slct_estado").val(alumno['estado']);
                $("#submit").val('1');

            }
        });
  }

  function CambiarEstado(id,estado){
        var datos=$("#form_alumno").serialize().split("txt_").join("").split("slct_").join("");
        $.ajax({
            url         : url + 'alumno/cambiarestado',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : {id:id,estado: estado},
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){
                    $('#t_alumnos').dataTable().fnDestroy();
                    ListarAlumnos();
                }
                else{
                    $.each(obj.msj,function(index,datos){
                        $("#error_"+index).attr("data-original-title",datos);
                        $('#error_'+index).css('display','');
                    });
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);

            }
        });

    }
