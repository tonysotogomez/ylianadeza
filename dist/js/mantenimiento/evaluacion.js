$(document).ready(function() {
  ListarEvaluaciones();
});

  function ListarEvaluaciones(){
    $.ajax({
          url         : url + 'evaluacion/listar',
          type        : 'POST',
          cache       : false,
          dataType    : 'json',
          beforeSend : function() {
              $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
          },
          success : function(obj) {
              if(obj.rst==1){
                  HTMLCargarEval(obj.listado);
              }
              $(".overlay,.loading-img").remove();
          },
          error: function(){
              $(".overlay,.loading-img").remove();
              mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
          }
      });
  }

  function HTMLCargarEval(datos){
    var html="";
    var con = 0;
    var fecha, genero, nombres, estadohtml;
    $('#t_evaluaciones').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        html+="<tr>"+
            "<td>N°"+data.numero+"</td>"+
            "<td>"+data.fecha+"</td>"+
            "<td><label class='label bg-green'>"+data.cantidad+"</label> aulas</td>"+
            "<td>"+data.total+" aulas</td>"+
            '<td><button type="button" title="Ver" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>';
          //  ' <a href="'+url+'alumno/perfil/'+data.id+'"><button title="Historial" type="button" class="btn btn-sm btn-info"><i class="fa fa-area-chart"></i></button></a></td>';
        html+="</tr>";
    });
    $("#tb_evaluaciones").html(html);
    $("#t_evaluaciones").dataTable({
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
