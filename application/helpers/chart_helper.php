<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function script_pie($num, $datos)
{
  $script = "<script>
  $(function () {
    $('#pie_container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Resultados Evaluacion N°1'
        },
        subtitle: {
            text: '".$datos[0]->aula."'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Alumnos',
            colorByPoint: true,
            data: [{
                name: 'Normales',
                y: ".$datos[0]->normales.",
                sliced: true,
                selected: true
            }, {
                name: 'Obesos',
                y: ".$datos[0]->obesos."

            }, {
                name: 'Sobrepesos',
                y: ".$datos[0]->sobrepesos."
            }, {
                name: 'Desnutricion Aguda',
                y: ".$datos[0]->agudas."
            },{
                name: 'Desnutricion Severa',
                y: ".$datos[0]->severos."
            }, {
                name: 'Desnutricion Cronica',
                y: ".$datos[0]->cronicos."
            }]
        }]
    });
});
</script>";
  return $script;
}


function script_barras($num, $datos)
{
  $script = "<script>
  $(function () {
    // Create the chart
    $('#bar_container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Resultados Evaluacion N°1'
        },
        subtitle: {
            text: '".$datos[0]->aula."'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Cantidad de alumnos'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style=\"font-size:11px\">{series.name}</span><br>',
            pointFormat: '<span style=\"color:{point.color}\">{point.name}</span>: <b>{point.y:.f}</b><br/>'
        },

        series: [{
            name: 'Alumnos',
            colorByPoint: true,
            data: [{
                name: 'Normales',
                y: ".$datos[0]->normales."
            }, {
                name: 'Obesos',
                y: ".$datos[0]->obesos."
            }, {
                name: 'Sobrepesos',
                y: ".$datos[0]->sobrepesos."
            }, {
                name: 'Desnutricion Aguda',
                y: ".$datos[0]->agudas."
            }, {
                name: 'Desnutricion Severa',
                y: ".$datos[0]->severos."
            }, {
                name: 'Desnutricion Cronica',
                y: ".$datos[0]->cronicos."
            }]
        }]
    });
});
</script>";
  return $script;
}
