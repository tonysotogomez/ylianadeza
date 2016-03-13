$(document).ready(function() {
  ListarAulas();
});

function Nuevo(){
  $("#txt_nombre").val('');
  $("#txt_descripcion").val('');
  $("#slct_tipo").val('0');
  $("#slct_estado").val('1');
  $('#aulaModal').find('.modal-title').text('Nueva Aula');
  $('#aulaModal').modal('show');
  $("#submit").val('0');
  $('#submit').text('Guardar');
}

function listar_todos(){
  var id = $('#aula_id').val();
  var todos = $('#todos').val();
  var accion = 'aula/listar_todos';
  if(todos==1){
      accion = 'aula/listar';
  }
  $.ajax({
        url         : url + accion,
        type        : 'POST',
        cache       : false,
        dataType    : 'json',
        data        : {id: id, todos: todos},
        beforeSend : function() {
            $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
        },
        success : function(obj) {
            if(obj.rst==1){
                HTMLCargarAlumno(obj.listado);
            }
            $('#todos').val(obj.all);
            $(".overlay,.loading-img").remove();
        },
        error: function(){
            $(".overlay,.loading-img").remove();
            mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
        }
    });
}

  function ListarAulas(){
    $.ajax({
          url         : url + 'aula/listado',
          type        : 'POST',
          cache       : false,
          dataType    : 'json',
          beforeSend : function() {
              $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
          },
          success : function(obj) {
              if(obj.rst==1){
                  HTMLCargarAula(obj.listado);
              }
              $(".overlay,.loading-img").remove();
          },
          error: function(){
              $(".overlay,.loading-img").remove();
              mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
          }
      });
  }

  function HTMLCargarAula(datos){
    var html="";
    var con = 0;
    var estadohtml;
    $('#t_aulas').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        con++;

        estadohtml='<span id="'+data.id+'" onClick="CambiarEstado('+data.id+','+data.estado+')" class="btn btn-danger btn-xs">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.id+'" onClick="CambiarEstado('+data.id+','+data.estado+')" class="btn btn-success btn-xs">Activo</span>';
        }
        html+="<tr>"+
            "<td>"+con+"</td>"+
            "<td>"+data.titulo+"</td>"+
            "<td>"+data.edades+"</td>"+
            "<td>"+data.aula+"</td>"+
            "<td>"+estadohtml+"</td>"+
            '<td><button type="button" title="Editar" onclick="Cargar('+data.id+')" class="btn btn-sm btn-primary btn-xs"><i class="fa fa-edit"></i></button>';
          //  ' <a href="'+url+'alumno/perfil/'+data.id+'"><button title="Historial" type="button" class="btn btn-sm btn-info"><i class="fa fa-area-chart"></i></button></a></td>';
        html+="</tr>";
    });
    $("#tb_aulas").html(html);
    $("#t_aulas").dataTable({
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
        var tipo = $('#slct_tipo').val();
        var nombre = $('#txt_nombre').val();
        if(tipo == 0) {
          alert('Selecciona un tipo de aula'); return;
        }
        if(nombre.trim() == ''){
          alert('Ingresa un nombre de aula'); return;
        }
        var datos=$("#form_aula").serialize().split("txt_").join("").split("slct_").join("");
        var accion="aula/crear";
        if(AE==1){
            accion="aula/editar";
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
                      $('#t_aulas').dataTable().fnDestroy();
                      ListarAulas();
                      $('#aulaModal .modal-footer [data-dismiss="modal"]').click();
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
    $('#aulaModal').modal('show');
    $('#aulaModal').find('.modal-title').text('Editar Aula');
    $('#submit').text('Editar');
        $.ajax({
            url         : url + "aula/cargar",
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : {id: id},
            success : function(data) {
                var aula = data['aula'][0];
                $("#txt_id").val(aula['id']);
                $("#txt_nombre").val(aula['titulo']);
                $("#txt_descripcion").val(aula['edades']);
                $("#slct_tipo").val(aula['idTipo']);
                $("#slct_estado").val(aula['estado']);
                $("#submit").val('1');

            }
        });
  }

  function CambiarEstado(id,estado){
        var datos=$("#form_aula").serialize().split("txt_").join("").split("slct_").join("");
        $.ajax({
            url         : url + 'aula/cambiarestado',
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
                    $('#t_aula').dataTable().fnDestroy();
                    ListarAulas();
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
