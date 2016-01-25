
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
