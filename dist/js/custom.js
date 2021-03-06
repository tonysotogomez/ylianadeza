$(document).ready(function() {
  totalAlumnos();
});

jQuery(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) { // on tab selection event
    jQuery( ".contains-chart" ).each(function() { // target each element with the .contains-chart class
        var chart = jQuery(this).highcharts(); // target the chart itself
        chart.reflow() // reflow that chart
    });
})
/**
 * Muestra un mensaje al pie de la página
 *
 * @param String tipo "success" para OK o "danger" para ERROR
 * @param String texto El mensaje a mostrar
 * @param Int tiempo Tiempo que tarda en desaparecer el mensaje
 * @returns {undefined}
 */
function mensaje(tipo, texto, tiempo){
    if(tipo == 'success') { var icon = 'check'}
    else { var icon = 'ban'};
    $("#msj").html('<div class="alert alert-dismissable alert-'+tipo+'">' +
            '<h4><i class="fa fa-'+icon+'"></i> Mensaje </h4>' +
            '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
            '<b>' + texto + '</b>' +
            '</div>');
    $("#msj").effect('shake');
    $("#msj").fadeOut(tiempo);
}

function lock(){
    $('body').css('overflow', 'hidden');
    $("body").append('<div class="overlay lockscreen lock" id="block"></div>');
    $('#block').load(url+'dist/lockscreen.php');

    // slight update to account for browsers not supporting e.which
    function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
    // To disable f5
        /* jQuery < 1.7 */
    $(document).bind("keydown", disableF5);
    /* OR jQuery >= 1.7 */
    $(document).on("keydown", disableF5);

    // To re-enable f5
        /* jQuery < 1.7 */
    $(document).unbind("keydown", disableF5);
    /* OR jQuery >= 1.7 */
    $(document).off("keydown", disableF5);

}
$('#pass_lock').keypress(function (e) {
  if (e.which == 13) {
    $('form#lockscreen').submit();
  }
});
function unlock(){
  var pass = $('#pass_lock').val();
  console.log(pass);
  if($.trim(pass) != 'yliana'){
    alert('Contraseña Incorrecta');
  } else {
    $('body').css('overflow', 'scroll');
    $(".overlay,.lockscreen,.lock").remove();
    $('#block').remove();
  }
}

function totalAlumnos(){
  $.ajax({
        url         : url + 'alumno/total',
        type        : 'POST',
        cache       : false,
        dataType    : 'json',
        success : function(html) {
          $("#total").text(html.total);
        }
    });
}


function carcularEdad(fecha_nacimiento){
  if( fecha_nacimiento != null){
    //calcular edad
    var fecha = fecha_nacimiento;
    // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes ) {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia)) {
            edad--;
        }
        if (edad > 1900) {
            edad -= 1900;
        }
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia) {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
  /*
        if (edad > 0) edadf = edad+'años ' + meses+' meses';
        else edadf = meses+' meses ';
*/

        var anios = '';
        var meses_1 = '';
        if(meses <= 12){
          if(meses == 1) meses_1 = meses+'mes';
          else meses_1 = meses+'meses';
        }
        if(edad >= 1){
          if(edad == 1) anios = edad+'año ';
          else anios = edad+'años ';
        }
        edadf = anios + meses_1;

//si esta sin formato, es decir: 1970-01-01
        if(fecha_nacimiento == '1970-01-01' || fecha_nacimiento == '01-01-1970') {
          edadf = ' ';
        }

        return edadf;
     //fecha = data.fecha_nacimiento;
  } else return edadf = 0;//retorna edas y meses
}
