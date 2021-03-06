$(document).ready(function() {
  ListarAlumnos();
  calcularallTotales();
  cargarAula(); //cargo las aulas en el modal

  $('#txt_nombres').on('change', function(e){
    var nombres = $('#txt_nombres').val();
    $.ajax({
        url         : url + "alumno/verificar",
        type        : 'POST',
        cache       : false,
        dataType    : 'json',
        data : {nombres : nombres},
        success : function(data) {
          div = $('#txt_nombres').parent();
          if ( data.rst == 1) {
            $('#txt_nombres').prev().html(data.msj);
            div.addClass("has-warning");
          } else {
            $('#txt_nombres').prev().html('Nombres:');
            div.removeClass("has-warning");
          }
        }
    });
  });

  $('#form_alumno').submit(function(e) {
    e.preventDefault();
    var tipo = $("#submit").val();
    AgregarEditar(tipo);
  });
});


function cargarAula(){
  $.ajax({
      url         : url + "aula/listado_select",
      type        : 'POST',
      cache       : false,
      dataType    : 'json',
      success : function(data) {
          var i, len, selected = '', opciones = '';
          var aulas = data.aulas;
          var id = $('#aula_id').val();
          for (i = 0, len = data['aulas'].length; i < len; i++) {
            if (id == aulas[i]['id']) { selected = 'selected'; }
            else { selected = ''; }
            opciones += '<option value="'+aulas[i]['id']+'" '+selected+'>'+aulas[i]['nombre']+'</option>';
          }
          $('#slct_aula').html('');
          $('#slct_aula').append(opciones);
      }
  });
}

function Nuevo(){
  $("#txt_apellidos").val('');
  $("#txt_nombres").val('');
  $("#txt_titular").val('');
  $('input[name="radiogenero"][value="h"]').prop('checked', true);
  $("#txt_fecha").val('');
  $("#slct_estado").val('1');
  $('#alumnoModal').find('.modal-title').text('Nuevo Alumno');
  $('#alumnoModal').modal('show');
  $("#submit").val('0');
  $('#submit').text('Guardar');
}

function calcularTotales(){
  var id = $('#aula_id').val();
  $.ajax({
        url         : url + 'aula/calcularTotales',
        type        : 'POST',
        cache       : false,
        dataType    : 'json',
        data        : {idAula: id},
        success : function(obj) {
            html = '';
            if(obj.rst==1){
              html+='<span class="text-muted well well-sm no-shadow" style="color:#001F3F;"><i class="fa fa-male"></i> <i class="fa fa-arrow-right"></i>'+obj.hombres+'</span>';
              html+='<span class="text-muted well well-sm no-shadow" style="color:#D81B60;"><i class="fa fa-female"></i> <i class="fa fa-arrow-right"></i>'+obj.mujeres+'</span>';
              html+='<span class="text-muted well well-sm no-shadow" style="color:#111111;"><i class="fa fa-users"></i> <i class="fa fa-arrow-right"></i>'+obj.totales+'</span>';
              $('#contenedor_totales').html(html);

            }
        }
    });
}

function calcularallTotales(){
  $.ajax({
        url         : url + 'aula/calcularTotales',
        type        : 'POST',
        cache       : false,
        dataType    : 'json',
        success : function(obj) {
            html = '';
            if(obj.rst==1){
              html+='<span class="text-muted well well-sm no-shadow" style="color:#001F3F;"><i class="fa fa-male"></i> <i class="fa fa-arrow-right"></i>'+obj.hombres+'</span>';
              html+='<span class="text-muted well well-sm no-shadow" style="color:#D81B60;"><i class="fa fa-female"></i> <i class="fa fa-arrow-right"></i>'+obj.mujeres+'</span>';
              html+='<span class="text-muted well well-sm no-shadow" style="color:#111111;"><i class="fa fa-users"></i> <i class="fa fa-arrow-right"></i>'+obj.totales+'</span>';
              $('#contenedor_totales').html(html);

            }
        }
    });
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

  function ListarAlumnos(){
    var id = $('#aula_id').val();
    var todos = $('#todos').val();
    var accion = 'aula/listar';
    if(todos==1){
        accion = 'aula/listar_todos';
    }
    $.ajax({
          url         : url + accion,
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
        if(nac[0] == 1970) fecha = " ";

        if(data.genero != null) genero = data.genero.toUpperCase();
        else genero = "No registrado";

        if(data.nombres != null) nombres = data.nombres;
        else nombres = "No registrado";

        estadohtml='<span id="'+data.id+'" onClick="CambiarEstado('+data.id+','+data.estado+')" class="btn btn-danger btn-xs">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.id+'" onClick="CambiarEstado('+data.id+','+data.estado+')" class="btn btn-success btn-xs">Activo</span>';
        }
        html+="<tr>"+
            "<td>"+con+"</td>"+
            "<td>"+data.apellidos+"</td>"+
            "<td>"+nombres+"</td>"+
            "<td>"+genero+"</td>"+
            "<td>"+fecha+"</td>"+
            "<td>"+data.titular+"</td>"+
            "<td>"+data.aula+"</td>"+
            "<td>"+estadohtml+"</td>"+
            '<td>'+
            '<button type="button" title="Editar" onclick="Cargar('+data.id+')" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></button> '+
            '<button type="button" title="Eliminar" onclick="Eliminar('+data.id+')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button> '+
            '<a href="'+url+'alumno/perfil/'+data.id+'"><button title="Perfil" type="button" class="btn btn-xs btn-info"><i class="fa fa-area-chart"></i></button></a></td>'+
            '</td>';
          //  ' <a href="'+url+'alumno/perfil/'+data.id+'"><button title="Historial" type="button" class="btn btn-sm btn-info"><i class="fa fa-area-chart"></i></button></a></td>';
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
        "oLanguage": {
          "sUrl": url+"plugins/datatables/language/esp.txt"
        },
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
              console.log(data);
                $(".overlay,.loading-img").remove();
                if(data.rst==1){
                      $('#t_alumnos').dataTable().fnDestroy();
                      ListarAlumnos();
                      calcularallTotales();
                      $('#alumnoModal .modal-footer [data-dismiss="modal"]').click();
                      mensaje(data.tipo, data.msj, 5000);
                  }
                  else{
                      mensaje('error', data.msj, 5000);
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
                $("#slct_aula").val(alumno['idAula']);
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
                    calcularallTotales();
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

    function Eliminar(id){
      if (confirm('¿Estas seguro de eliminar el alumno?')){
          $.ajax({
              url         : url + 'alumno/eliminar',
              type        : 'POST',
              cache       : false,
              dataType    : 'json',
              data        : {id:id},
              beforeSend : function() {
                  $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
              },
              success : function(obj) {
                  $(".overlay,.loading-img").remove();
                  if(obj.rst==1){
                      $('#t_alumnos').dataTable().fnDestroy();
                      ListarAlumnos();
                      calcularTotales();
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
      }
